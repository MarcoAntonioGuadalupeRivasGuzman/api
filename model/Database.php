<?php
class Database{
    protected $connection=null;

    public function __construct(){
        try{
            $this->connection = new mysqli(DBHOST,DBUSERNAME, DBPASSWORD, DATABASENAME);

            if (mysqli_connect_erno()){
                throw new Exception("Could not connect to database.");
            }
        }
        catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function select($query="",$params=[]){
        try{
            $stmt=$this->executeStatement($query, $params);
            $result=$stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        }
        catch(Exception $e){
            throw new Exception( $e->getMessage());
        }
    }

    private function executeStatement($query="", $params=[]){
        try{
            $stmt=$this->connection->prepare($query);

            if($stmt===false){
                throw new Exception("Unable to do prepared statement: ".$query);
            }

            if($params){
                $stmt->bind__param($params[0], $params[1]);
            }
            $stmt->execute();

            return $stmt;
        }
        catch(Exception $e){
            throw new Exception($e->getMessag());
        }
    }
}
?>