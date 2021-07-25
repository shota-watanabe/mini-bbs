<?php
session_start();
unset($_SESSION['adminID']);

setcookie('adminID', '', time()-3600);

header('Location: ../index.php');
exit();
?>