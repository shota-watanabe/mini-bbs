<?php
session_start();
require('dbconnect.php');

$id = $_REQUEST['id'];

$members = $db->prepare('SELECT * FROM members WHERE id=?');
$members->execute(array($id));
$message = $messages->fetch();

$del = $db->prepare('DELETE FROM members WHERE id=?');
$del->execute(array($id));

header('Location: admin.php');
exit();
