<?php
require_once '../db.php';
require_once '../checksession.php';

$id = $_GET['id'];
$q = $_GET['q'];
$name = $_GET['name'];
$exists = false;

$sql = 'select distinct date_format(date_created, "%Y-%m-%d %H:%i:%s") as date from experiment where exp_name="' . $name . '";';
$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    $datetime2 = new DateTime();
    $datetime1 = new DateTime($row['date']);
    $interval = $datetime1->getTimestamp() - $datetime2->getTimestamp();
    if(abs($interval) > 60)
        $exists = true;
}

$sql = 'INSERT INTO experiment (exp_name, item_id, quantity) VALUES ("' . $name . '", ' . $id . ', ' . $q . ');';
if (!$exists) {
    $conn->query($sql);
    echo 'done';
} else {
    echo 'exists';
}
