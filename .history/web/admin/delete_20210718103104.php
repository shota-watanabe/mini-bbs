<?php
session_start();
require('../dbconnect.php');

if (isset($_SESSION['id'])) {
    $id = $_REQUEST['id'];

    // 削除するユーザの取得
    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members->execute(array($id));
    $member = $messages->fetch();

    if ($member['id'] == $_SESSION['id']) {
        $del = $db->prepare('DELETE FROM members WHERE id=?');
        $del->execute(array($id));
    }
}
print(error_reporting(E_ALL));
header('Location: admin.php');
exit();
?>