<?php
session_start();
require_once "../../vendor/autoload.php";

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

$bucket = 'watasho-bucket';
$key = 'AKIATTWSU5EIRMRSN7G6';
$secret = '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';

// S3クライアントを作成
$s3 = new S3Client(array(
    'version' => 'latest',
    'credentials' => array(
        'key' => $key,
        'secret' => $secret,
    ),
    'region'  => 'ap-northeast-1', // 東京リージョン
));

$file = $_FILES['image']['tmp_name'];

// S3バケットに画像をアップロード
try {
    $result = $s3->putObject(array(
        'Bucket' => $bucket,
        'Key' => $_SESSION['join']['image'],
        'Body' => fopen($file, 'rb'),
        'ACL' => 'public-read', // 画像は一般公開されます
        'ContentType' => mime_content_type($file),
    ));
}catch(S3Exception $e){
    print('エラー：' . $e->getMessage());
}


// 結果を表示
echo "<pre>";
var_dump($result);
echo "</pre>";
?>