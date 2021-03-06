<?php

require __DIR__ . '/../bootstrap.php';

use PayPal\Auth\Openid\PPOpenIdTokeninfo;
use PayPal\Exception\PPConnectionException;

session_start();

// ### User Consent Response
// PayPal would redirect the user to the redirect_uri mentioned when creating the consent URL.
// The user would then able to retrieve the access token by getting the code, which is returned as a GET parameter.
if (isset($_GET['success']) && $_GET['success'] == 'true') {

    $code = $_GET['code'];

    try {
        // Obtain Authorization Code from Code, Client ID and Client Secret
        $accessToken = PPOpenIdTokeninfo::createFromAuthorizationCode(array('code' => $code), null, null, $apiContext);
    } catch (PPConnectionException $ex) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            var_dump($ex->getData());
            exit(1);
    }

    print_result("Obtained Access Token", "Access Token", $accessToken->getAccessToken(), $accessToken);

}
