<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require('../dbconnect.php');

if (isset($_SESSION['id'])) {
    $memberID = $_REQUEST['id'];

    // 削除するユーザの取得
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($id));
    $member = $members->fetch();

    if ($member['id'] == $_SESSION['id']) {
        $del = $db->prepare('DELETE FROM members WHERE id=?');
        $del->execute(array($memberID));
    }
    var_dump($memberID);
}else{
    header('Location: admin.php');
    exit();
}

?>