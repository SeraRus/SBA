<!DOCTYPE html>
<?php

if (isset($_POST["password"]) && isset($_POST["email"])) {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "kaikai0226@";
    $dbname = "userDB";
    $conn = mysqli_connect($servername, $username, $password);
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_query($conn , "set names utf8");

	$logInEmail = $_POST["email"];
	$logInPassword = hash("sha256", $_POST["password"]);

    $sql = "SELECT * FROM userDB.userID WHERE email = '$logInEmail';";

    $result = $conn->query($sql);
}

?>
<html lang="zh_hk">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>登入</title>
</head>
<body align="center">
<div class="select" align="left">
    <a href="home.php">&lt;返回</a>
</div>
<p class="title">登入</p>
<p class="mint"><a href="signIn.php">還沒有帳戶？點這裡註冊</a></p>
<div class="content">
    <div class="search">
        <form method="POST" action="login.php">
            <label><input type="text" class="box" placeholder="電子郵件/手機號碼" name="email"></label><br>
            <label><input type="text" class="box" placeholder="密碼" name="password"></label><br>
            <p><input type="submit" class="find" value="登入"></p>
        </form>
		<?php
        if (isset($_POST["password"]) && isset($_POST["email"])) {
			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc();
				if ($logInPassword == $row['passwordHash']) {
					setcookie("user", $row['username'], time() + 1800);
					header('location: home.php');
				} else {
					echo "密碼錯誤";
				}
			} else {
				echo "用戶不存在";
			}
		}
		?>
    </div>
    <span>&copy;2024 EricWang</span>
</div>
</body>
</html>