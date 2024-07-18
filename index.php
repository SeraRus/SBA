<!DOCTYPE html>
<html lang="zh_hk">
<?php

$servername = "127.0.0.1";
$username = "root";
$password = "kaikai0226@";
$dbname = "userDB";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}
mysqli_query($conn , "set names utf8");

$sql = "SELECT id, username, email, passwordHash
FROM userDB.userID;";

mysqli_select_db( $conn, 'userDB' );
$loginDB = mysqli_query( $conn, $sql );
if(! $loginDB )
{
    die('無法讀取數據: ' . mysqli_error($conn));
}
echo '<h2>用戶數據</h2>';
echo '<table border="1"><tr><td>ID</td><td>用戶名</td><td>郵箱</td><td>密碼(SHA256)</td></tr>';
while($row = mysqli_fetch_array($loginDB, MYSQLI_ASSOC))
{
    echo "<tr><td> {$row['id']}</td> ".
        "<td>{$row['username']} </td> ".
        "<td>{$row['email']} </td> ".
        "<td>{$row['passwordHash']} </td> ".
        "</tr>";
}
echo '</table>';
mysqli_close($conn);


header('location: home.php');
exit();

?>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

</body>
</html>