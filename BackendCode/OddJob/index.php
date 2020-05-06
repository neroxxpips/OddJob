<?php
ini_set("allow_url_fopen", 1);

// Insert api call here
$url = 'http://localhost:8080/allavailablerequests?street=%22Pryor%20St%20SW%22&number=30&city=%22Atlanta%22&state=%22Georgia%22';

$obj = json_decode(file_get_contents($url), true);



for ($i = 0; $i < count($obj['requestArray']); $i++) {
	echo $obj['requestArray'][$i]['title'] . " ";
	echo $obj['requestArray'][$i]['price'];
	echo "<br>";
}

?>