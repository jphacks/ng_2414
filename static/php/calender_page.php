<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カレンダーページ</title>
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/calender_page_index.css">
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
    <h1>カレンダー</h1>
    <div id="calendar"></div>

    <h2>選択された日付に来た人たちの写真</h2>
    <div id="photo-list">
        <!-- 写真一覧がここに表示されます -->
    </div>

    <!-- FullCalendar JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            // カレンダーの表示
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',  // 月表示
                dateClick: function(info) {
                    // 日付がクリックされたとき
                    var date = info.dateStr;  // クリックされた日付 (例: 2023-10-24)
                    fetchPhotosForDate(date);
                }
            });

            calendar.render();

            // 特定の日付の写真を取得する関数
            function fetchPhotosForDate(date) {
                // サーバーにその日付のデータをリクエスト
                fetch('/get_photos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ date: date })
                })
                .then(response => response.json())
                .then(data => {
                    displayPhotos(data.photos);  // 取得した写真データを表示
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }

            // 写真を表示する関数
            function displayPhotos(photos) {
                const photoList = document.getElementById('photo-list');
                photoList.innerHTML = '';  // 既存の写真をクリア

                photos.forEach(photo => {
                    const img = document.createElement('img');
                    img.src = photo;  // サーバーから送られてきた画像URL
                    img.alt = "人物の写真";
                    img.style.maxWidth = "150px";  // サイズ調整
                    img.style.margin = "10px";     // 間隔調整
                    photoList.appendChild(img);
                });
            }
        });
    </script>
</body>
</html>

