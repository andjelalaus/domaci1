<?php
class Zvanje{
    public $idZ;   
    public $nameZ;   

    
    public function __construct($idZ=null,$nameZ=null)
    {
        $this->idZ = $idZ;
        $this->nameZ = $nameZ;
    }

    #prikazi sva zanimanja

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT * FROM zvanje";
        return $conn->query($query);
    }

    #nadji po id-u

    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM zvanje WHERE id=$id";

        $niz = array();
        if($nizOdBaze= $conn->query($query)){
            while($line = $nizOdBaze->fetch_array(1)){
                //dodaje novi red u niz
                $niz[]= $line;
            }
        }

        return $niz;

    }

    #obrisi profu po id-u

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM zvanje WHERE id=$this->idZ";
        return $conn->query($query);
    }

    #promeni profu
    public static function update(Zvanje $zv, mysqli $conn)
    {
        $query = "UPDATE zvanje SET naziv = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $zv->nameZ,$zv->idZ);
        return $stmt->execute();
    }

    #dodaj profu
    public static function add(Zvanje $zv, mysqli $conn)
    {
        $query = "INSERT INTO zvanje(naziv) VALUES('$zv->nameZ')";
        return $conn->query($query);
    }
}

?>