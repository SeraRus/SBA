<?php
$db_server = '127.0.0.1';
$db_username = 'root';
$db_password = 'kaikai0226@';
$db_database = 'userDB';
$link = mysqli_connect($db_server, $db_username, $db_password, $db_database);
if (!$link) {
    die("ERROR: Webserver could not connect to database!");
} ?>
<html lang="zh_hk">
<body>
    <h1>USER</h1>
    <table>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>email</th>
            <th>hash</th>
        </tr>
        <?php
        /** @noinspection SqlResolve */
        $query = "SELECT * FROM userID";
        $result = mysqli_query($link, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['passwordHash']}</td>
        </tr>";
        }
        ?>
    </table>
</body>
</html>