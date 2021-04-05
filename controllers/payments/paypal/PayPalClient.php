<?php

require_once('../../../app/config.php');
require_once(__DIR__ . '/../../../vendor/autoload.php');

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        switch (PAYPAL_ENV) {
            case 'development':
                return new SandboxEnvironment(PAYPAL_PUBLIC, PAYPAL_SECRET);
            
            case 'production':
                return new LiveEnvironment(PAYPAL_PUBLIC, PAYPAL_SECRET);

            default:
                die("El ecosistema de PayPal es inválido!");
        }
        
    }
}