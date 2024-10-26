<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Known Persons</title>
    <link rel="stylesheet" href="../css/known_page_index.css">
    <style>
        img {
            width: 150px;
            height: auto;
            margin: 10px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="top_page.php"> <!-- トップページへのリンク -->
                <img src="../../logo3.png" alt="Logo" class="logo"> <!-- 一つ上の階層から画像を読み込む -->
            </a>
          <ul class="nav">
            <li class="header-hover-color"><a href="suspicious_page.php">不審者</a></li>
            <li class="header-hover-color"><a href="known_page.php">知人</a></li>
            <li class="header-hover-color"><a href="calender_page.php">カレンダー</a></li>
            <li class="header-hover-color"><a href="interphone_page.php">インターホン</a></li>
            <li class="header-hover-color"><a href="target_danger_page.php">危険人物リスト</a></li>
          </ul>
        </div>
    </header>
    <h1>知人リスト</h1>
    <div id="gallery">
        <?php
        
        //画像が保存されているかのフラグ
        $has_image = false;

        $image_folder = "../images/known/";

        //フォルダ内のファイルを取得
        if (is_dir($image_folder)) {
            if ($handle = opendir($image_folder)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != '.' && $file != '..' && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                        $has_image = true;
                        
                        // ファイル名から拡張子を除去
                        $fileNameWithoutExt = pathinfo($file, PATHINFO_FILENAME);
                        echo '<div class="image-container">';
                        echo '<p class="name_style">' . $fileNameWithoutExt . '</p>';
                        echo '</div>';
                    }
                }
                closedir($handle);
            }
        }

        //画像が保存されていなかったら「知人情報が保存されていません」と表示
        if(!$has_image){
            echo '<div class="gallery-text">知人情報が保存されていません。</div>';
        }
        ?>
    </div>
</body>
</html>