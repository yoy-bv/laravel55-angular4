<?php

namespace App\Http\Middleware;

use Closure;
use Response;
class Cors {
public function handle($request, Closure $next)
{
header('Access-Control-Allow-Origin: *');
$headers = [
'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
'Access-Control-Allow-Headers' => 'X-Requested-With, Content-Type, x-xsrf-token, X-Auth-Token, Origin, Authorization'
];

$response = $next($request);
foreach ($headers as $key => $value)
$response->header($key, $value);
return $response;
}
}