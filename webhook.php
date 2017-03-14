<?php

require_once 'vendor/autoload.php';

use Facebook\FacebookRequest;

$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];

if ($verify_token === 'abcd1234') {
echo $challenge;
}

$input = json_decode(file_get_contents('php://input'),true);

if ($input['entry'][0]['changes'][0]['field'] === 'feed'){

$comment_id = $input['entry'][0]['changes'][0]['value']['comment_id'];

$fb = new Facebook\Facebook([
  'app_id' => '200067863810508',
  'app_secret' => '3dc73640902a7878d855661569ba18a6',
  'default_graph_version' => 'v2.5',
]);


$access_tok = 'EAAC19e30EcwBAFDgvZC5r9ZBsovMm8wNAZA56x6IxzVXE89pJfds0tvrFUNSinXOV1a3BD32MuM8JA3DXb5QnsSl8P8Wh6i4tccZCY1mlAFB2cN98gwrTCH2XcDkVnkybjuykTZAoZCsZBoV5uErw7RUExkhvzSGxwZD';

$appId = '200067863810508';
$msg = "Hey, Thank you for your comments, we are working with people in several Industry to boost their pipeline with leads. Let us know your Industry you are in and we will let you know the best offer";

try{
            $posturl = '/'.$comment_id .'/private_replies?message='. $msg ;
           $result = $fb->post($posturl,array("access_token" => $access_tok,  "app_id" => $appId));

            if($result){
                echo 'Successfully posted to Facebook Wall...';
            }
        }catch(FacebookApiException $e){
            echo $e->getMessage();
        }

}

?>