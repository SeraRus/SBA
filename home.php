<!DOCTYPE html>
<html lang="zh_hk">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>首頁</title>
</head>
<body align="center">
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
    <div class="header">
        <div class="logo">
            <p><img src="cardBack.png" alt="logo" width="100"></p>
        </div>
        <div class="select">
            <a href="deck.html">卡組</a>
        </div>
    </div>
    <div class="content">
        <div class="search">
			<form method="GET" action="search.php" target="_blank">
				<label><input type="text" class="box" name="id" placeholder="輸入卡片密碼/名稱" required></label>
				<input type="submit" class="find" value="查詢">
			</form>
        </div>
        <div class="ws">
            <a href="about.html">關於</a>
        </div>

        <div class="bottom">&copy;2024 EricWang</div>
    </div>

</body>
</html>