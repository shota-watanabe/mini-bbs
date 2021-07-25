<?php
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

public function upload(Request $request, int $id)
{
    //拡張子で画像でないファイルをはじく
    $ext = substr($filename, strrpos($_FILES['img_path']['name'], '.') + 1);

    //読み込みの際のキーとなるS3上のファイルパスを作る(作り方は色々あると思います)
    $tmpname = str_replace('/tmp/','',$_FILES['img_path']['tmp_name']);
    $new_filename = 'profiles/'.$id.'-'.time().'-'.$tmpname.'.'.$ext;

    //S3clientのインスタンス生成(各項目の説明は後述)
    $s3client = S3Client::factory([
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
        ],
        'region' => 'ap-northeast-1',
        'version' => 'latest',
    ]);
    //バケット名を指定
    $bucket = getenv('S3_BUCKET_NAME')?: die('No "S3_BUCKET_NAME" config var in found in env!');
    //アップロードするファイルを用意
    $image = fopen($_FILES['img_path']['tmp_name'],'rb');

    //画像のアップロード(各項目の説明は後述)
    try{
        $result = $s3client->putObject([
            'ACL' => 'public-read',
            'Bucket' => $bucket,
            'Key' => $new_filename,
            'Body' => $image,
            'ContentType' => mime_content_type($_FILES['img_path']['tmp_name']),
        ]);
    }catch(S3Exception $e){
        print('アップロードエラー：' . $e->getMessage());
    }

    //読み取り用のパスを返す
    $path = $result['ObjectURL'];

    //パスをDBに保存(ここの詳細処理は今回は記述しません)
    $this->userRepository->updateUserProfsById($id, 'img_path', $path);
}
?>