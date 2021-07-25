<?php
session_start();

if (!empty($_POST)) {
    $id = $_POST['id'];
  
    if ($_POST['id'] !== '' && $_POST['password'] !== '') {
        if ($_POST['id'] === "admin@admin.com" && $_POST['password'] === "pass01") {
            $_SESSION['id'] = $id;
            $_SESSION['time'] = time();
            if ($_POST['save'] === 'on') {
                setcookie('id', $_POST['id'], time()+60*60*24*14);
            }
            header('Location: admin.php');
            exit();
        } else {
            // 管理者情報が空の場合ログイン失敗
            $error['login'] = 'failed';
        }
    } else {
        // id、パスどちらかが空の場合
        $error['login'] = 'blank';
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>ログインする</title>
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ログインする</h1>
  </div>
  <div id="content">
    <div id="lead">
      <p>IDとパスワードを記入してログインしてください。</p>
    </div>
    <form action="" method="post">
      <dl>
        <dt>ID</dt>
        <dd>
          <input type="text" name="id" size="35" maxlength="255" value="<?php print(htmlspecialchars($id, ENT_QUOTES)); ?>" />
          <?php if ($error['login'] === 'blank'): ?>
          <p class="error">* IDとパスワードをご記入ください</p>
          <?php endif; ?>
          <?php if ($error['login'] === 'failed'): ?>
          <p class="error">* ログインに失敗しました。正しくご記入ください</p>
          <?php endif; ?>
        </dd>
        <dt>パスワード</dt>
        <dd>
          <input type="password" name="password" size="35" maxlength="255" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>" />
        </dd>
        <dt>ログイン情報の記録</dt>
        <dd>
          <input id="save" type="checkbox" name="save" value="on">
          <label for="save">次回からは自動的にログインする</label>
        </dd>
      </dl>
      <div>
        <input type="submit" value="ログインする" />
      </div>
    </form>
  </div>
</div>
</body>
</html>