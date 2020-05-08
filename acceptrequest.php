<?php
session_start();

$reqID = intval($_POST["req"]);
$userID = $_SESSION["username"];

echo $reqID  . ", " . $userID;
ini_set("allow_url_fopen", 1);

$url = 'http://localhost:8080/useracceptedrequest';

$data = array (
    'userid' => $userID,
    'requestid' => $reqID,
);

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
            
            
header("Location: homepage.php");
?>