<?php
​
ini_set("allow_url_fopen", 1);
​
$url = 'http://localhost:8080/request';
$data = array(
    'title' => 'This might break',
    'post' => 'iamscared',
    'price' => 16.00,
    'number' => 101,
	'street' => 'Piedmont Ave SE',
	'state' => 'Georgia',
	'city' => 'Atlanta',
	'zip' => 30022,
	'task' => 'maintenance',
	'image' => 'hello',
	'userid' => 'test5'
);
// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
         'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
var_dump($result);
​
?>