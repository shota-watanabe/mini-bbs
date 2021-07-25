<?php
try{
  $db = new PDO('mysql:dbname=mini_bbs;port=8889;host=localhost;charset=utf8','b805e0979f7c66', '6d2f31e6');
}catch(PDOException $e){
  print('DB接続エラー：' . $e->getMessage());
}
?>              