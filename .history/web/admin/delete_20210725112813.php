<?php
session_start();
require('../dbconnect.php');

$id = $_REQUEST['id'];

// 削除するユーザの取得
$members = $db->prepare('SELECT * FROM members WHERE id=?');
$members->execute(array($id));
$member = $members->fetch();

$del = $db->prepare('DELETE FROM members WHERE id=?');
$del->execute(array($id));

$posts = $db->prepare('SELECT * FROM posts WHERE member_id=?');
$posts->execute(array($id));
$post = $posts->fetch();

$del = $db->prepare('DELETE FROM posts WHERE member_id=?');
$del->execute(array($id));

header('Location: admin.php');
exit();

?>