<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Manila');
 
// variables used for jwt
$key = "example_key"; //unique secret key
$iss = "http://example.org";
$aud = "http://example.com";
$iat = 1356999524;
$nbf = 1357000000;

// The rest is called the registered claim names. The iss (issuer) claim identifies the principal that issued the JWT.

// The aud (audience) claim identifies the recipients that the JWT is intended for. The iat (issued at) claim identifies the time at which the JWT was issued.

// The nbf (not before) claim identifies the time before which the JWT MUST NOT be accepted for processing.

// You can use another useful claim name called exp (expiration time) which identifies the expiration time on or after which the JWT MUST NOT be accepted for processing.
?>