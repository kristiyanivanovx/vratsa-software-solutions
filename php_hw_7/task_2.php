<?php

$rows = 14;
$cols = 6;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<table border="1">
    <?php

    for ($i = 1; $i <= $rows; $i++) {
        echo "<tr>";

        for($j = 1; $j <= $cols; $j++) {
            echo "<td>$i - $j</td>";
        }
        echo "</tr>";
    }

    ?>
</table>

</body>
</html>
