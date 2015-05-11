<?php 
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
// Instantiate without defaults
//$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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');

// Instantiate with defaults, so all messages created
// will be sent from 'Cyril' and to the #accounting channel
// by default. Any names like @regan or #channel will also be linked.
$settings = [
    'username' => 'SupportBot',
    'channel' => '#adviser-support',
    'link_names' => true,
    'icon' => ':hamburger:'
];

$client = new Maknz\Slack\Client('https://hooks.slack.com/services/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', $settings);

//$authentication = 
$message = $_POST["message"];
//channels: 
$channel = $_POST['channel'];

if(!empty($channel) && $channel != 'default'){
$client->to('#'.$channel)->send($message);	
}else{
$client->send($message);
}

//https://secure.numun.org/slack/app/test.php


?>