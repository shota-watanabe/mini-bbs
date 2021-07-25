<?php
session_start();
unset($_SESSION['adminID']);
if(ini_get('session.use_cookies')){
    $params = session_get_cookie_params();
    setcookie(session_name() , '', time() - 42000,
       $params['path'], $params['domain'], $params
       ['secure'], $params['httponly']);
}
session_destroy();

setcookie('adminID', '', time()-3600);

header('Location: ../index.php');
exit();
?>