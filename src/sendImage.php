< ?php
/* ========================================================================
 *
 * @category   Application of hoge
 * @author     woodsmall inc. <hoge@woodsmall.co.jp>
 * @copyright  2013 woodsmall inc.
 * @version    Rev 1.0.0
 * @link       http://woodsmall.co.jp
 *
 * @brie       画像のアップロードを行い、同時にサムネイルを生成する
 * @note
 *   
 * @param      N/A
 * @return     正常：アップロードファイル名   異常：エラーメッセージ
 * ========================================================================
*/
 
 
// パス設定
define("ROOT_PATH", realpath("./"));


$rename_dir = "1111.png";


if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) { 
    if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $_FILES["upfile"]["name"])) {
        chmod("files/" . $_FILES["upfile"]["name"], 0644);
        //echo $_FILES["upfile"]["name"] . "をアップロードしました。";
    
         
        // 画像をリネームして移動
        rename($_FILES["upfile"]["name"], $rename_dir);
/*         
        // サムネイルを生成
        $file = $_FILES["upfile"]["name"];
        $image = imagecreatefrompng( $file );
        if ($image) {
         
            $width  = imagesx( $image );
            $height = imagesy( $image );
            if ( $width >= $height ) {
                //横長の画像の時
                $side = $height;
                $x = floor( ( $width - $height ) / 2 );
                $y = 0;
                $width = $side;
            } else {
                //縦長の画像の時
                $side = $width;
                $y = floor( ( $height - $width ) / 2 );
                $x = 0;
                $height = $side;
            }
             
             
            $thumbnail_width  = 300;
            $thumbnail_height = 300;
            $thumbnail = imagecreatetruecolor( $thumbnail_width, $thumbnail_height );
             
             
//          imagecopyresized( $thumbnail, $image, 0, 0, $x, $y, $thumbnail_width, $thumbnail_height, $width, $height );
            imagecopyresampled( $thumbnail, $image, 0, 0, $x, $y, $thumbnail_width, $thumbnail_height, $width, $height );
            $result = imagepng( $thumbnail, $thumb );
            if ($result) {
                echo $rename_dir;
            } else {
                echo "ERROR imagepng!!n". $Ymd;
            }
        } else {
            echo "ERROR imagecreatefrompng!!n";
        }
         */
        // メモリ上の画像データを破棄
        imagedestroy($image);
        imagedestroy($thumbnail);
 
    } else {
        echo "ファイルをアップロードできません。";
    }
} else {
    echo "ファイルが選択されていません。";
}