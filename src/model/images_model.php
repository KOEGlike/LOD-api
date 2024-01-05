<?php 
$dir=getenv("ROOT_DIR");
require_once  $dir."/model//database.php";

class ImagesModel extends DataBase
{
    public function insertImage(int $originId,string $fileName):void
    {
        try{
            $this->executeStatement ('INSERT INTO photos (fileName, LODid) VALUES (:name, :LODid )', 
        [[':name',$fileName],[':LODid',$originId]]);
        }
        catch(Exception $e)
        {
            throw new Exception($e->getMessage(), 1);  
        }
    }

    public function getImages(int $originId):array
    {
        
        try {
            $images = $this->select("SELECT * FROM photos WHERE LODid = :value",[[":value", $originId]]);
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
                    $this->executeStatement("UPDATE photos SET likes = likes+1 WHERE id = :id",[[":id", $id]]);
                }
                else
                {
                    $this->executeStatement("UPDATE photos SET  dislikes = dislikes + 1 WHERE id = :id",[[":id", $id]]);
                }
                
            }
            catch(Exception $e)
            {
                throw new Exception($e->getMessage(), 1);
                
            }
    }
}
?>