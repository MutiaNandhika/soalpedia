<?php
include_once("config.php");

$result = mysqli_query($mysqli, "SELECT * FROM random ORDER BY id ASC");
?>

<!DOCTYPE html>

<head>
    <title>Document</title>
</head>
<body>
    <table>
    <?php
        while ($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$user_data['id']."</td>";
            echo "<td>".$user_data['name']."</td>";
        }
    ?>
    </table>
</body>
</html>