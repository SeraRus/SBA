<!DOCTYPE html>
<html lang="zh_hk">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>卡牌搜索</title>
	<style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            text-align: center;
            width: 300px;
        }
        .card img {
            max-width: 200px;
            max-height: 200px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }
	</style>
</head>
<body>
<div class="header">
	<h1>卡牌搜索</h1>
	<div class="select" align="right">
        <?php
        if (isset($_COOKIE["user"])) {
            $user = $_COOKIE["user"];
            echo "<p>$user <a href='logout.php'>登出</a></p>";
        } else {
            echo "<a href=\"login.php\">登入/注冊</a>";
        }
        ?>
	</div>
</div>
<div class="card-container">
    <?php
    // 連接到數據庫
    $servername = "127.0.0.1";
    $username = "root";
    $password = "kaikai0226@";
    $dbname = "userDB";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 檢查連接是否成功
    if ($conn->connect_error) {
        die("數據庫連接失敗: " . $conn->connect_error);
    }

    // 獲取卡片 ID
    if (isset($_GET['id'])) {
        $cardId = $_GET['id'];

    	if (is_numeric($cardId)) {
            // 查詢數據庫
            $sql = "SELECT * FROM cards WHERE id = $cardId";
            $result = $conn->query($sql);
		} else {

            // 查询数据库
            $sql = "SELECT * FROM cards WHERE name LIKE '%$cardId%'";
            $result = $conn->query($sql);
        }
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo '<div class="card">';
                $directory = 'cards';
                $images = scandir($directory);

                $found = false;

                $cardIdWithoutLeadingZero = ltrim($row['id'], '0');

                foreach ($images as $image) {
                    if ($image !== '.' && $image !== '..') {
                        if ($image == $cardIdWithoutLeadingZero . '.jpg' || $image == $cardIdWithoutLeadingZero . '.png') {
                            echo '<img src="' . $directory . '/' . $image . '" alt="' . $image . '">';
                            $found = true;
                        }
                    }
                }
				echo '<h3>' . $row['name'] . '</h3>';
				echo '<p>' . $row['desc'] . '</p>';
				echo '<p>' . $row['str1'] . '</p>';
				echo '<p>' . $row['str2'] . '</p>';
				echo '<p>' . $row['str3'] . '</p>';
				echo '<p>' . $row['str4'] . '</p>';
				echo '<p>' . $row['str5'] . '</p>';
				echo '<p>' . $row['str6'] . '</p>';
				echo '<p>' . $row['str7'] . '</p>';
				echo '<p>' . $row['str8'] . '</p>';
				echo '<p>' . $row['str9'] . '</p>';
				echo '<p>' . $row['str10'] . '</p>';
				echo '<p>' . $row['str11'] . '</p>';
				echo '<p>' . $row['str12'] . '</p>';
				echo '<p>' . $row['str13'] . '</p>';
				echo '<p>' . $row['str14'] . '</p>';
				echo '<p>' . $row['str15'] . '</p>';
				echo '<p>' . $row['str16'] . '</p>';
				echo '</div>';
				}
		} else {
			echo '<p>找不到該卡片</p>';
		}

    } else {
        echo '<p>未提供輸入</p>';
    }

    $conn->close();
    ?>
</div>
</body>
</html>