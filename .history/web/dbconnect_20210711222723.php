<?php
function dbConnect(){
    $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
    $db['heroku_4cdaad9dd2284c4'] = ltrim($db['path'], '/');
    $dsn = "mysql:host={$db['us-cdbr-east-04.cleardb.com']};dbname={$db['heroku_4cdaad9dd2284c4']};charset=utf8";
    $user = $db['b805e0979f7c66'];
    $password = $db['6d2f31e6'];
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
    );
    $dbh = new PDO($dsn,$user,$password,$options);
    return $dbh;
  }
?>              