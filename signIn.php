<!DOCTYPE html>
<?php
require 'emailValid.php';

if (isset($_POST["password"]) && isset($_POST["username"]) && isset($_POST["email"])) {

    $servername = "127.0.0.1";
    $username = "root";
    $password = "kaikai0226@";
    $dbname = "userDB";
    $conn = mysqli_connect($servername, $username, $password);
    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_query($conn, "set names utf8");


    $shaPassword = hash("sha256", $_POST["password"]);
    $usernames = $_POST["username"];
    $email = $_POST["email"];

    $column_name = "email";

    $sql = "SELECT * FROM userDB.userID WHERE $column_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<html lang="zh_hk">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>注冊</title>
</head>
<body align="center">
<div class="select" align="left">
    <a href="home.php">&lt;返回</a>
</div>
<p class="title">注冊</p>
<p class="mint"><a href="login.php">已經有帳戶了？點這裡登入</a></p>
<p class="mint">如使用電話號碼註冊，請加入+852/+86等區號</p>
<div class="content">
    <div class="search">
        <form method="POST" action="signIn.php">
            <label><input type="text" class="box" placeholder="用戶名" name="username"></label><br>
            <label><input type="text" class="box" placeholder="電子郵件/電話號碼" name="email"></label><br>
            <label><input type="text" class="box" placeholder="密碼" name="password"></label><br>
            <p><input type="submit" class="find" value="注冊"></p>
        </form>
		<?php
        if (isset($_POST["password"]) && isset($_POST["username"]) && isset($_POST["email"])) {
			if ($result->num_rows > 0) {
				echo "電郵/電話已使用，請使用其他電郵/電話或點擊<a href='login.php'>此處</a>登入";
            } elseif (!mailValid($email) && $email[0] != '+') {
				if (is_numeric($email)) {
                    echo "電話格式不正確";
				} else {
                    echo "電郵格式不正確";
				}
            } else {
                if (strlen($email) > 15 && $email[0] == '+') {
					echo "電話格式不正確";
                } else {
                    $sql = "INSERT INTO userDB.userID(username, email, passwordHash)
				VALUES('$usernames', '$email', '$shaPassword');";
                    $conn->query($sql);
                    setcookie("user", $usernames, time() + 1800);
                    header('location: home.php');
				}
			}
        }
		?>
    </div>
    <span>&copy;2024 EricWang</span>
</div>
</body>
</html>