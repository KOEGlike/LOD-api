<?php 
$dir=getenv("ROOT_DIR");
require_once  $dir."/model//database.php";

class ImagesModel extends DataBase
{
    public function insertImage(int $originId,string $fileName):void
    {
        try{
            $this->executeStatement ('INSERT INTO kepek (file_Name, origin_id) VALUES (:name, :origin_id )', 
        [[':name',$fileName],[':origin_id',$originId]]);
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), 1);  
        }
    }

    public function getImages(int $originId):array
    {
        
        try {
            $images = $this->select("SELECT * FROM kepek WHERE origin_id = :value",[[":value", $originId]]);
        } catch (Exception $e) {
            throw $e;
        }
            return $images;
    }

    public function vote(int $id,bool $isYes):void
    {
        try
            {
                if ($isYes == true)
                {
                    $this->executeStatement("UPDATE kepek SET votes = votes+1, votes_amount = votes_amount + 1 WHERE id = :id",[[":id", $id]]);
                }
                else
                {
                    $this->executeStatement("UPDATE kepek SET votes = votes-1, votes_amount = votes_amount - 1 WHERE id = :id",[[":id", $id]]);
                }
                
            }
            catch(Exception $e)
            {
                throw new Exception($e->getMessage(), 1);
                
            }
    }
}
?>