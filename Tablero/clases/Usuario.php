<?php
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

require_once("conectar.php");
require_once("helpers.php");

//require_once('../../Tablero/vo/UsuarioVO.php');

class Usuario extends conectar {

    private $db;

    //crear nuestro constructor - metodo magico
    public function __construct() {
        $this->db = parent::conectar(); //parent p' hacer referencia a la clase padre
        parent::setNames();
    }

    public function getDatos($login) {
        try {
            $sql = "SELECT id FROM docente where email='" . $login . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return $row['id'];
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function existeCorreo($correo) {
        try {
            $sql = "SELECT id FROM docente where email='" . $correo . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }

    public function existeCorreoIdentidad($correo, $identidad) {
        try {
            $sql = "SELECT id FROM docente where email='" . $correo . "' and documentoidentidad ='" . $identidad . "';";
            $datos = pg_query($this->db, $sql);
            $result= pg_fetch_array($datos);
            //var_dump($sql);
            //if (is_array($result)) {
            while ($row = $result) {
                return true;
            }
        } catch (Exception $error) {
          
        }
        return false;
    }

    public function existeIdentidad($identidad) {
        try {
            $sql = "SELECT id FROM docente where documentoidentidad='" . $identidad . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }

    public function getToken($correo) {
        try {
            $sql = "SELECT id as token FROM docente where email='" . $correo . "';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return sha1($row['token']);
            }
        } catch (Exception $error) {
            
        }
        return false;
    }

    public function esCalificado($id) {
        try {
            $sql = "SELECT docente_id FROM calificacion WHERE docente_id =" . $id . " and estado='CALIFICADO';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }
    
    public function esActualizado($id) {
        try {
            $sql = "SELECT fechacambio FROM docente WHERE id=" . $id . " and fechacambio >=(SELECT fechainicio FROM convocatoria where estado='ACTIVA');";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }
    
    public function esValledupar($id) {
        try {
            $sql = "SELECT id FROM docente where id = ".$id." and sede = 'VALLEDUPAR';";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }

    public function miSede($id) {
        try {
            $sql = "SELECT sede FROM docente where id = ".$id.";";
            $datos = pg_query($this->db, $sql);
            while ($row = pg_fetch_array($datos)) {
                return true;
            }
        } catch (Exception $error) {
            
        }
        return false;
    }

    public function validarUsuarioAdmin($login, $pass) {
        try {
            $passe = sha1($pass);
            $sql = "SELECT id, nombre, correo, habilitado, facultad_id,tipo,sede FROM usuario where trim(upper(usuario))=trim(upper('" . $login . "')) and clave = '" . $passe . "' and correo!='DECANO' and correo!='JEFE' and estado='ACTIVO';";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/UsuarioVO.php');
            $usuario = new UsuarioVO();
            while ($row = pg_fetch_array($datos)) {
                $id = $row['id'];
                $name = $row['nombre'];
                $email = $row['correo'];
                $usuario->setId($id);
                $usuario->setName($name);
                $usuario->setMail($email);
                $usuario->setlastName($row['facultad_id']);
                $usuario->setIdentidad($id);
                $usuario->setTipo($row['tipo']);
                $usuario->setSede($row['sede']);
                return $usuario;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function validarUsuario($login, $pass) {
        try {
            $passe = sha1($pass);
            $sql = "SELECT id,nombre,apellidos,email,documentoidentidad,sede FROM docente where trim(upper(email))=trim(upper('" . $login . "')) and clave = '" . $passe . "';";
            $datos = pg_query($this->db, $sql);
            require_once('../../Tablero/vo/UsuarioVO.php');
            $usuario = new UsuarioVO();
            while ($row = pg_fetch_array($datos)) {
                $id = $row['id'];
                $identidad = $row['documentoidentidad'];
                $name = $row['nombre'];
                $email = $row['email'];
                $lastName = $row['apellidos'];
                $usuario->setId($id);
                $usuario->setIdentidad($identidad);
                $usuario->setName($name);
                $usuario->setMail($email);
                $usuario->setlastName($lastName);
                $usuario->setSede($row['sede']);
                return $usuario;
            }
        } catch (Exception $error) {
            
        }
        return null;
    }

    public function enviarCorreo() {
        $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
        $mail = strtolower(trim(filter_input(INPUT_POST, 'correoTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
        
        if ($this->existeCorreoIdentidad($mail, $identidad)) {
            try {
                ///////////////otro sistema de correos
                include("phpMail/envioCorreo.php");
                $email = new email("Aplicacionhv","saumar2003@gmail.com","gzswzduuqhdnwrej");
                $email->agregar($mail, $identidad);
                ///////////////////////////////
                $token = $this->getToken($mail);
                $ruta = $_SERVER['DOCUMENT_ROOT'];
                $host = $_SERVER["HTTP_HOST"];
                $url = $_SERVER["REQUEST_URI"];
                
                $trama = "http://hojasdevida.unicesar.edu.co/rh/Tablero/restaurarclave.php?email=" . $mail . "&identidad=" . $identidad . "&token=" . $token;
                $para = $mail;
                $titulo = 'Recuperación de su clave de acceso inscripción docente';
                $mensaje = '<!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                </head>
                <body style="font-family: Arial, Helvetica, sans-serif;">
                    <table align="center" border="2" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                        <tr>
                           
                            <td width="100%" style="text-align:center" >
                                <img alt="texto" src="https://hojasdevida.unicesar.edu.co/rh/images/titulo.png" width="446"
                                    height="77" style="display: block;">
                            </td>
                        </tr>
                    </table>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                        <tr>
                            <td colspan="2" style="text-align:center" valign="top">
                                <br><br><br><br>
                                Señor aspirante a docente:
                                <b> <a href="'.$trama.'"> Para cambiar su contraseña haga clic aqui</a></b><br>
                                <br><br>
                                Si surge algún inconveniente, puede dirigirse por correo a <a
                                    href="mailto:sistemas@unicesar.edu.co?Subject=Banco%20de%20Hojas%20de%20Vida">sistemas@unicesar.edu.co</a>
                                <br><br><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 30px 20px 0px 20px; text-align:center; font-size: 11px;" bgcolor="#B9E85C ">
                                <b>UNIVERSIDAD POPULAR DEL CESAR<br> Oficina de Informatica y Sistemas - DM</b>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>';
               $cabeceras = 'From: aplicacioneshv@unicesar.edu.co' . "\r\n" .
                        'Reply-To: aplicacioneshv@unicesar.edu.co' . "\r\n" .
                        'Content-type:text/html;charset=UTF-8' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                     
                       ///////
                $respuesta = $email->enviar($titulo,$mensaje);///este es el metodo smtp por gmail
                /////////////////////////////////
                //$respuesta = mail($para, $titulo, $mensaje, $cabeceras);////ESTE ES EL METODO 
                var_dump($respuesta);
            } catch (Exception $error) {
                $respuesta = false;
                //echo "error: ". $error->getMessage(); exit();
            }
            if ($respuesta) {
                 ?>
                 <script type="text/javascript">
                window.location="EnvioCorreo.php";
                </script>
                <?php
            } /*else {

                ?>
                <script type="text/javascript">
                 window.location="NoEnviaCorreo.php";
               </script>
               <?php
                //header ("Location: NoEnviaCorreo.php");
            }*/
        }else{
            //echo "error2";exit();
             ("Location: NoEnviaCorreo.php");
        }
    }

    public function insertar() {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $nombres = strtoupper(trim(filter_input(INPUT_POST, 'nombreTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $apellidos = strtoupper(trim(filter_input(INPUT_POST, 'apellidosTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $documentoTipo = trim(filter_input(INPUT_POST, 'documentoCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            ////
            $nuevaSede = trim(filter_input(INPUT_POST, 'sedeCmb', FILTER_SANITIZE_SPECIAL_CHARS));
            ////
            $clave = trim(filter_input(INPUT_POST, 'claveTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $confirmar = trim(filter_input(INPUT_POST, 'confirmarTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $correo = strtolower(trim(filter_input(INPUT_POST, 'correoTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            $confirmarCorreo = trim(filter_input(INPUT_POST, 'confirmarCorreoTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            if ($identidad == '' || $nombres == '' || $apellidos == '' || $documentoTipo == '' || $clave == '' ||
                    $confirmar == '' || $correo == '' || $confirmarCorreo == '') {
                $mensajeMostrar = "Hay campos vacios, recuerde que todos los campos son obligatorios";
                $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                if (strlen($correo) > 5 && strlen($identidad) > 5) {
                    if ($confirmarCorreo == $correo) {
                        if (!$this->existeIdentidad($identidad)) {
                            if (!$this->existeCorreo($correo)) {
                                if ($clave == $confirmar) {
                                    $clave = sha1($confirmar);
                                    $sql = "INSERT INTO docente(nombre, apellidos, tipodocumento, documentoidentidad, email,"
                                            . " clave, estado_civil, genero, paisorigen, departamento, municipio, direccion,"
                                            . " telefono, celular, fechanacimiento, fecharegistro, escalafondocente, sede) "
                                            . " VALUES('" . $nombres . "', '" . $apellidos . "', '" . $documentoTipo . "', '" . $identidad . "', '"
                                            . $correo . "', '" . $clave . "', '', '', '', '', '', '', '', '', CURRENT_DATE, now(), '', '".$nuevaSede."');";
                                    pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                                    header("Location: clases/Correctos/Usuario.html");
                                    exit;
                                } else {
                                    $mensajeMostrar = "La confirmación de la clave es incorrecta";
                                    $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                                    header($mensaje);
                                    exit;
                                }
                            } else {
                                $mensajeMostrar = "El correo ya existe registrado";
                                $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                                header($mensaje);
                                exit;
                            }
                        } else {
                            $mensajeMostrar = "El número de identidad ya existe registrado";
                            $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                            header($mensaje);
                            exit;
                        }
                    } else {
                        $mensajeMostrar = "La confirmación del correo es incorrecta";
                        $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                } else {
                    $mensajeMostrar = "El correo y la clave deben tener 3 o más caracteres";
                    $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                    header($mensaje);
                    exit;
                }
            }
        } catch (Exception $error) {
            
        }
    }

    public function actualizarClave() {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt1', FILTER_SANITIZE_SPECIAL_CHARS));
            $clave = trim(filter_input(INPUT_POST, 'claveTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $confirmar = trim(filter_input(INPUT_POST, 'confirmarTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $correo = strtolower(trim(filter_input(INPUT_POST, 'correoTxt1', FILTER_SANITIZE_SPECIAL_CHARS)));
            $token = strtolower(trim(filter_input(INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS)));
            if ($identidad == '' || $clave == '' ||
                    $confirmar == '' || $correo == '') {
                $mensajeMostrar = "Hay campos vacios, recuerde que todos los campos son obligatorios";
                $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                $confirmado = $this->getToken($correo);
                if ($token == $confirmado) {
                    if ($this->existeCorreo($correo)) {
                        if ($clave == $confirmar) {
                            $clave = sha1($confirmar);
                            $sql = "UPDATE docente set clave = '" . $clave . "' where email = '" . $correo . "';";
                            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                            header("Location: clases/Correctos/Usuario.html");
                            exit;
                        } else {
                            $mensajeMostrar = "La confirmación de la clave es incorrecta";
                            $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                            header($mensaje);
                            exit;
                        }
                    } else {
                        $mensajeMostrar = "El correo ya existe registrado";
                        $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                } else {
                    $mensajeMostrar = "El Token no es válido, se intenta de forma incorrecta";
                    $mensaje = "Location: clases/Incorrectos/Usuario.php?mensaje=" . $mensajeMostrar;
                    header($mensaje);
                    exit;
                }
            }
        } catch (Exception $error) {
            
        }
    }

    public function actualizarClaveAdmin() {
        try {
            $identidad = trim(filter_input(INPUT_POST, 'identificacionTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $clave = trim(filter_input(INPUT_POST, 'claveTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $confirmar = trim(filter_input(INPUT_POST, 'confirmarTxt', FILTER_SANITIZE_SPECIAL_CHARS));
            $correo = strtolower(trim(filter_input(INPUT_POST, 'correoTxt', FILTER_SANITIZE_SPECIAL_CHARS)));
            if ($identidad == '' || $clave == '' ||
                    $confirmar == '' || $correo == '') {
                $mensajeMostrar = "Hay campos vacios, recuerde que todos los campos son obligatorios";
                $mensaje = "Location: clases/Incorrectos/UsuarioAdmin.php?mensaje=" . $mensajeMostrar;
                header($mensaje);
                exit;
            } else {
                $confirmado = $this->getToken($correo);
                    if (!$this->existeCorreo($correo)) {
                        if ($this->existeIdentidad($identidad)) {
                        if ($clave == $confirmar) {
                            $clave = sha1($confirmar);
                            $sql = "UPDATE docente set clave = '" . $clave . "', email='".$correo."' where documentoidentidad = '" . $identidad . "';";
                            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                            header("Location: clases/Correctos/UsuarioAdmin.html");
                            exit;
                        } else {
                            $mensajeMostrar = "La confirmación de la clave es incorrecta";
                            $mensaje = "Location: clases/Incorrectos/UsuarioAdmin.php?mensaje=" . $mensajeMostrar;
                            header($mensaje);
                            exit;
                        }
                    } else {
                        $mensajeMostrar = "La identidad no existe registrada";
                        $mensaje = "Location: clases/Incorrectos/UsuarioAdmin.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                    }else {
                        if ($this->existeCorreoIdentidad($correo, $identidad)) {
                            if ($this->existeIdentidad($identidad)) {
                        if ($clave == $confirmar) {
                            $clave = sha1($confirmar);
                            $sql = "UPDATE docente set clave = '" . $clave . "', email='".$correo."' where documentoidentidad = '" . $identidad . "';";
                            pg_query($this->db, $sql) or die('La consulta fallo: ' . pg_last_error());
                            header("Location: clases/Correctos/UsuarioAdmin.html");
                            exit;
                        } else {
                            $mensajeMostrar = "La confirmación de la clave es incorrecta";
                            $mensaje = "Location: clases/Incorrectos/UsuarioAdmin.php?mensaje=" . $mensajeMostrar;
                            header($mensaje);
                            exit;
                        }
                    } else {
                        $mensajeMostrar = "La identidad no existe registrada";
                        $mensaje = "Location: clases/Incorrectos/UsuarioAdmin.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                    }
                        }else{
                        $mensajeMostrar = "El correo ya está registrado con otra identidad";
                        $mensaje = "Location: clases/Incorrectos/UsuarioAdmin.php?mensaje=" . $mensajeMostrar;
                        header($mensaje);
                        exit;
                        }
                    }
            }
        } catch (Exception $error) {
            
        }
    }
    
    public function actualizarDatos() {
        //sentencia sql para actualizar y/0 editar datos
        $sql = "update usuarios
             set
            nombre='" . $_POST["nombre"] . "',
            correo='" . $_POST["correo"] . "',
            telefono='" . $_POST["telefono"] . "',
            fecha='" . $_POST["fecha"] . "'
            where
            id='" . $_POST["id"] . "'";
        $this->db->query($sql);
    }

    public function eliminarDatos() {
        $sql = "delete from usuarios
            where id='" . $_GET["id"] . "'";
        $this->db->query($sql);
    }

}
