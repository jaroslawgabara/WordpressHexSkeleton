<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

$name = 'app';

add_action( 'rest_api_init', function () use ($name) {
    register_rest_route( $name, '/api/(.*?)', array(
        'methods' => 'GET,POST,PUT,DELETE',
        'callback' => 'apiHandler',
    ) );
} );


function apiHandler()
{
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once __DIR__.'/../vendor/autoload.php';
    require dirname(__DIR__).'/config/preload.php';
    
    
    if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
        Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_PORT | Request::HEADER_X_FORWARDED_PROTO);
    }
    
    if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
        Request::setTrustedHosts([$trustedHosts]);
    }
    
    $kernel = new Kernel('dev', true);
    $request = Request::createFromGlobals();
    $response = $kernel->handle($request);
    $response->send();
    die;
    $kernel->terminate($request, $response);
}