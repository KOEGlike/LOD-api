<?php
class BaseController
{
    protected function getUriSegments():string
    {
        $uri = parse_url ($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        return $uri;
    }
    
    protected function getQueryStringParams():array
    {
        parse_str($_SERVER['QUERY_STRING'], $query);
        return $query;
    }
   
    protected function sendResponse(int $code,array $response=[],array $headers = array("Content-Type: application/json"),bool $success=null):void
    {

        http_response_code($code);
        if($success==null)
        {
            switch ($code/100) {
                case 2:
                    $success=true;
                    break;
                case 4:
                    $success=false;
                    break;
                case 5:
                    $success=false;
                    break;
                default:
                $success=null;
                    break;
            }
        }
        header_remove('Set-Cookie');
        if (is_array($headers) && count($headers)) 
        {
            foreach ($headers as $header) 
            {
                header($header);
            }
        }
        header("Access-Control-Allow-Origin:*;", false);
        header("Access-Control-Allow-Methods:GET,PUT,PATCH,POST,DELETE;",false);
        $response["success"]=$success;
        echo json_encode($response);
        exit;
    }   

    protected function errorResponse(int $code,array $err):void
    {
        $this->sendResponse($code, [ "message" => $err ]);
    }

    public function methodNotSupported():void
    {
        $this->sendResponse(400, [ "message" => "this method is not supported on this endpoint"]);
    }

    protected function wrongMethod():void
    {
        $this->sendResponse(500, [ "message" => "this function was atatched to the wrong method by the programmer"]);
    }

    public function thisEndpointDoseNotExist():void
    {
        $this->sendResponse(400, [ "message" => "this endpoint does not exist"]);
    }

}?>