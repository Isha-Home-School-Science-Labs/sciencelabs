<?php
require_once '../db.php';
require_once '../checksession.php';

$sql = "select * from item where lab='" . $_SESSION['lab'] . "';";
$result = $conn->query($sql);

$data = "";
$var = 0;
while ($row = $result->fetch_assoc()) {
    $data = $data .
        "<tr>" .
        "<td id='item" . $var . "'>" . $row['item_name'] .
        "<td id='item" . $var . "'>" . $row['specs'] .
        "<td>" . $row['quantity'] .
        "<td><input class='form-control input-sm' type='number'/>";
    $var++;
}
echo $data;