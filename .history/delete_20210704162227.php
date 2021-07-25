<?php
session_start();
require('dbconnect.php');

if(isset($_SESSION['id'])){
    $id = $_REQUEST['id'];

    $message = $db->prepare('SELECT * FROM posts WHERE id=?');
    $messages->execute(array($id));
    $message = $messages->fetch();
}