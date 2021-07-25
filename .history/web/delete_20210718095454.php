<?php
session_start();
require('dbconnect.php');

    $id = $_REQUEST['id'];

    $messages = $db->prepare('SELECT * FROM posts WHERE id=?');
    $messages->execute(array($id));
    $message = $messages->fetch();

    $del = $db->prepare('DELETE FROM posts WHERE id=?');
    $del->execute(array($id));

header('Location: index.php');
exit();
?>