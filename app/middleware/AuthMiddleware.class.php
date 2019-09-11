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
      $this->validToken($headers[0]);
      $response = $next($request, $response);
      return $response;
    } catch (Exception $e) {
      return $this->jsonResponse($e->getMessage(), 403);
    }
  }

  private function validToken($header) {
    $curl = curl_init(getenv('ACCOUNTS_API'));
    $options = array(
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER     => array(
          "Authorization: $header"
      )
    );
    curl_setopt_array($curl, $options);
    $http_resp = curl_exec($curl);
    $http_code = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
    curl_close($curl);
    if($http_code > 300) {
      throw new Exception(
        json_encode(
          [
            'message'=>'unauthorized',
            'stack' => $http_resp
          ]
        ), 403);
    }
  }
}
