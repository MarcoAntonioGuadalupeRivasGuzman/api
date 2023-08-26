<?php
class BaseController{
    // __call magic method
    public function __call($name, $arguments){
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    //get uri alements 
    //return array

    protected function geturiSegments(){
        $uri=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri=explode('/',$uri);

        return $uri;
    }

    //get querystring params
    //return array

    protected function getQueryStringParams(){
        return parse_str($_SERVER['QUERY_STRING'], $query);
    }

    //send api output
    
    protected function sedOutput($data,$httpHeaders=array()){
        header_remove('Set-Cookie');

        if(is_array($httpHeaders)&&count($httpHeaders)){
            foreach($httpHeaders as $httpHeader){
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }
}
?>