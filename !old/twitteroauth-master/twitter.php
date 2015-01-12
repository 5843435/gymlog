<?php

session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$conn = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

$result = $connection->get('account/verify_credentials');

var_dump($result)
