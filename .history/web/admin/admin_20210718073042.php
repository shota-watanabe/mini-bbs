<?php
session_start();
require('../dbconnect.php');

$page = $_REQUEST['page'];
if ($page == '') {
    $page = 1;
}
$page = max($page, 1);

$counts = $db->query('SELECT COUNT(*) AS cnt FROM members');
$cnt = $counts->fetch();
$maxpage = ceil($cnt['cnt'] / 5);
$page = min($page, $maxpage);
$start = ($page -1) * 5;

$members = $db->prepare('SELECT * FROM members WHERE id ORDER BY created DESC LIMIT ?,5');
$members->bindParam(1, $start, PDO::PARAM_INT);
$members->execute();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>管理画面</title>

	<link rel="stylesheet" href="../style.css" />
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>管理画面</h1>
  </div>
  <div id="content">
    <div style="text-align: left">登録ユーザリスト</div>
  	<div style="text-align: right"><a href="logout.php">ログアウト</a></div>
<br>
<?php foreach ($members as $member): ?>
    <div class="msg">
    <img src="../member_picture/<?php print(htmlspecialchars($member['picture'], ENT_QUOTES)); ?>"
    width="48" height="48" alt="<?php print(htmlspecialchars($member['name'], ENT_QUOTES)); ?>" />
    <p><span class="name">（<?php print(htmlspecialchars($member['name'], ENT_QUOTES)); ?>）</span></p>
    <p><span class="email">（<?php print(htmlspecialchars($member['email'], ENT_QUOTES)); ?>）</span></p>
    <p class="day"><?php print(htmlspecialchars($member['created'], ENT_QUOTES)); ?>
      [<a href="delete.php" style="color: #F33;">削除</a>]
      </p>
      </div>
<?php endforeach; ?>

<ul class="paging">
<?php if ($page > 1): ?>
<li><a href="index.php?page=<?php print($page-1); ?>">前のページへ</a></li>
<?php endif; ?>
<?php if ($page < $maxpage): ?>
<li><a href="index.php?page=<?php print($page+1); ?>">次のページへ</a></li>
<?php endif; ?>
</ul>
  </div>
</div>
</body>
</html>