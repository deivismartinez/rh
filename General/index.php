<?php
session_start();
session_destroy();
header('Location: ../Admin/index.php');