<?php

        $req        = intval($_POST['req']);
        $cardnum    = $_POST['card-number'];
        $cardtype   = $_POST['type'];
        $cardmon    = $_POST['expmonth'];
        $cardyear   = $_POST['expyear'];
        $cvv        = $_POST['cvv'];


        ini_set("allow_url_fopen", 1);

        $url = 'http://localhost:8080/paypalPayment';

        $data = array (
            'requestid' => $req,
            'card_num' => $cardnum,
            'card_type' => $cardtype,
            'card_month' => $cardmon,
            'card_year' => $cardyear,
            'card_cvv' => $cvv,
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


            $url = 'http://localhost:8080/archiverequest?requestID=' . $req;
            $obj = json_decode(file_get_contents($url), true);


        header("Location: profile.php");
    
?>