<?php

namespace App\Middleware;

use App\Controllers\BaseController;
use Exception;

class AuthMiddleware extends BaseController
{
  public function __invoke($request, $response, $next)
  {
    $this->setParams($request, $response, []);
    $headers = $this->request->getHeader('Authorization');
    if(!isset($headers[0])) {
      return $this->jsonResponse('bearer must be pass', 403);
    }
    try {
      $this->validToken($headers);
      $response = $next($request, $response);
      return $response;
    } catch (Exception $e) {
      return $this->jsonResponse($e->getMessage(), 403);
    }
  }

  private function validToken($header) {
    $curl = curl_init();
    $header = array(
      'Accept: application/json',
      'Authorization: '.$header
    );
    curl_setopt($curl, CURLOPT_URL, getenv('ACCOUNTS_API'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_exec($curl);
    $http_code = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
    curl_close($curl);
    if($http_code > 300) {
      throw new Exception('unathorized', 403);
    }
  }
}
