<?php

require __DIR__ . "/inc/bootstrap.php";

$uri=parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$uri=explode('/',$uri);

if((isset($uri[2])&& $uri[2]!='user')|| !isset($uri[3])){
    header("HTTP/1.1 404 Not Fopund");
    exit();
}

require PROJECT__ROOT_PATH . "/controller/api/usercontroller.php";

$objFeedController=new UserController();
$strMethodName=$uri[3] . 'Action';
$objFeedController->{$strMethodName}();
?>