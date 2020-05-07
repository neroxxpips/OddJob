<?php

include 'config.php';
if (empty($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$title = $_POST['title'];
$post = $_POST['post'];
$price = $_POST['price'];
$number = $_POST['number'];
$street = $_POST['street'];
$state = $_POST['state'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$task = $_POST['task'];
$image = $_POST['image'];
$userid = $_SESSION['username'];

ini_set("allow_url_fopen", 1);

$url = 'http://localhost:8080/request';

$data = array (
    'title' => $title,
    'post' => $post,
    'price' => (float) $price,
    'number' => (int) $number,
    'street' => $street,
    'state' => $state,
    'city' => $city,
    'zip' => (int) $zip,
    'task' => $task,
    'image' => $image,
    'userid' => $userid
);

echo "PLEASE " . $userid;
$options = array (
    'http' => array (
        'header' => "Content-Type: application/json\r\n" .
            "Accept: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode($data)
    )
    );
    
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result == FALSE) {
        var_dump($result);
    }
?>