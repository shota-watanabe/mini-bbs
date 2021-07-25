<?php
session_start();
require('dbconnect.php');

$members = $db->prepare('SELECT * FROM members WHERE id=?');
$members->execute(array($members));
$member = $members->fetch();

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
  	<div style="text-align: right"><a href="logout.php">ログアウト</a></div>

<?php foreach ($members as $member): ?>
    <div class="msg">
    <img src="member_picture/<?php print(htmlspecialchars($post['picture'], ENT_QUOTES)); ?>" width="48" height="48" alt="<?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?>" />
    <p><?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?><span class="name">（<?php print(htmlspecialchars($post['name'], ENT_QUOTES)); ?>）</span>[<a href="index.php?res=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)); ?>">Re</a>]</p>
    <p class="day"><a href="view.php?id=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)); ?>"><?php print(htmlspecialchars($post['created'], ENT_QUOTES)); ?></a>
    <?php if ($post['reply_message_id'] > 0): ?>
      <a href="view.php?id=<?php print(htmlspecialchars($post['reply_message_id'], ENT_QUOTES)); ?>">
      返信元のメッセージ</a>
      <?php endif; ?>
      <?php if ($_SESSION['id'] == $post['member_id']): ?>
      [<a href="delete.php?id=<?php print(htmlspecialchars($post['id'], ENT_QUOTES)); ?>"
      style="color: #F33;">削除</a>]
      <?php endif; ?>
      </p>
      </div>
<?php endforeach; ?>

<ul class="paging">
<?php if($page > 1): ?>
<li><a href="index.php?page=<?php print($page-1); ?>">前のページへ</a></li>
<?php endif; ?>
<?php if($page < $maxpage): ?>
<li><a href="index.php?page=<?php print($page+1); ?>">次のページへ</a></li>
<?php endif; ?>
</ul>
  </div>
</div>
</body>
</html>