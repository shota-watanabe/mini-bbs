<?php
session_start();
require('dbconnect.php');

$id = $_REQUEST['id'];

$members = $db->prepare('SELECT * FROM members WHERE id=?');
$members->execute(array($id));
$member = $messages->fetch();

if($member['id'] == $_SESSION['id']){
    $del = $db->prepare('DELETE FROM members WHERE id=?');
    $del->execute(array($id));
}

header('Location: admin.php');
exit();
?>
