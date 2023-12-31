<?php 
require_once  getenv("ROOT_DIR")."/model//database.php";

class LodModel extends DataBase
{
    public function insertNew(string $name) :int
    {
        try{
        $this->executeStatement('INSERT INTO  LODs(name) VALUES (:name)', [[':name', $name]]);
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), 1);  
        }

        return $this->conn->lastInsertId();
        
    }

    public function getLOD(int $id) :array
    {
        $LOD=$this->select("SELECT * FROM LODs WHERE id = :value",[[":value", $id]]);
        return $LOD;
    }
}
?>