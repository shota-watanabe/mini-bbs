<?php
try{
    $db = new PDO('mysql:dbname=heroku_4cdaad9dd2284c4;port=8889;host=us-cdbr-east-04.cleardb.com;charset=utf8','b805e0979f7c66', '6d2f31e6);
}catch(PDOException $e){
    print('DB接続エラー：' . $e->getMessage());
}
?>              