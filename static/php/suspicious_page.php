<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danger Persons</title>
    <link rel="stylesheet" href="../css/suspicious_page_index.css">
    <style>
        img {
            width: 150px;
            height: auto;
            margin: 10px;
        }
        /* 確認タブのスタイル */
        #confirmation {
            display: none; /* 初期状態では非表示 */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border: 1px solid #ccc;
            padding: 20px;
            z-index: 1000;
        }
    </style>
    <script>
        // PHPから画像の有無フラグを受け取る
        const hasImages = <?php echo json_encode($has_image); ?>;

        function showConfirmation(file) {
            if (hasImages) { // 画像が存在する場合のみ確認タブを表示
                document.getElementById('confirmation').style.display = 'block';
            }
        }

        function closeConfirmation() {
            document.getElementById('confirmation').style.display = 'none';
        }

        function addToDangerList() {
            console.log(selectedFile + ' を危険人物リストに追加しました。');
            closeConfirmation();
        }
    </script>
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
    <h1>不審者リスト</h1>

    <div id="gallery">
        <?php
        $has_image = false;
        $image_folder = "../images/danger/";

        if (is_dir($image_folder)) {
            if ($handle = opendir($image_folder)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != '.' && $file != '..' && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                        $has_image = true;
                        echo '<img src="' . $image_folder . $file . '" alt="' . $file . '" onclick="showConfirmation(\'' . $file . '\')">';
                    }
                }
                closedir($handle);
            }
        }

        if (!$has_image) {
            echo '<div class="gallery-text">不審者情報が保存されていません。</div>';
        }
        ?>
    </div>

    <!-- 確認タブ -->
    <div id="confirmation">
        <p>この人物を危険人物に追加しますか？</p>
        <button onclick="addToDangerList()">追加</button>
        <button onclick="closeConfirmation()">キャンセル</button>
    </div>
</body>
</html>
