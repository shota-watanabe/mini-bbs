<?php
session_start();
require('dbconnect.php');

$members = $db->prepare('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC LIMIT ?,5');
$members->bindParam(1, $start, PDO::PARAM_INT);
$members->execute();

?>