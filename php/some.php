<?php
/*
* Create short links script
*/

$db = [
    'user' => 'root',
    'pass' => 'root'
];

try {
    $pdo = new PDO('mysql:host=localhost;dbname=links', $db['user'], $db['pass']);
} catch (PDOException $e) {
    echo 'DB Error: ' . $e->getMessage();
    die();
}

$protocol = "http://";
$host = $_SERVER['HTTP_HOST'];
$shortLink = "";

if(isset($_GET['l'])) {
    //create shor link
    $shortLink = substr(md5(uniqid().rand(0,100)),1,5);
    $sql = 'INSERT INTO `links` (`link`, `short`, `created_at`) VALUES (?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_GET['l'],
        $shortLink,
        date('Y-m-d H:i:s')
    ]);
    echo $protocol . $host . '/' . $shortLink;
} else {
    if(isset($_GET['r'])) {
        $sql = 'SELECT `link` FROM `links` WHERE `short` = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_GET['r']
        ]);
        $row = $stmt->fetch();
        header('location: ' . $row[0]);
    }
}