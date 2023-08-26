<?php
class UserController extends BaseController{
    //user/list endpoint - get list of users

    public function listAction(){
        $strErrorDesc='';
        $requestMethod=$_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams=$this->getQueryStringParams();

        if(strtoupper($requestMethod)=='GET'){
            try{
                $userModel = new UderModel();
                
                $arrUsers=$userModel->getUsers();
                $responseData=json_encode($arrUsers);
            }
            catch(Error $e){
                $strErrorDesc=$e->getMessage(). 'Something went wrong! Please ctrl alt delte :(';
                $strErrorHeader='HTTP/1.1 500 Internal Server Error';
            }
        }
        else{
            $strErrorDes='Method not supported';
            $strErrorHeader='HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if(!$strErrorDesc){
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json','HTTP/1.1 200 OK')
            );
        }
        else{
            $this->sendOuput(json_encode(array('error'=>$strErrorDesc)),
                array('Content-Type: application/json',$strErrorHeader)
            );
        }
    }
}
?>