<?php

$arr = [];

$rows = 4;
$cols = 4;

$count = 1;

for($i = 0; $i < $rows; $i++) {
//    $arr[$i] = [];
    for($j = 0; $j < $cols; $j++) {
        $arr[$i][$j] = $count;
        $count += 1;
    }

    $count = $count * 2 - 1;
}

print "<table border='1'>";

for($m = 0; $m < $rows; $m++) {
    print "<tr>";

    for($k = 0; $k < $cols; $k++) {
        print "<td>";
        print $arr[$m][$k];
        print "</td>";
    }

    print "</tr>";
}

print "<table>";

print "<pre>";
var_dump($arr);
print "</pre>";
