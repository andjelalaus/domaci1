<?php
class Professor{
    public $id;   
    public $name;   
    public $lastname;   
    public $initalDate;   
    public $lastDate;   
    public $roleID;
    
    public function __construct($id=null,$name=null,$lastname=null,$initalDate=null, $lastDate=null, $roleID=null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->initalDate = $initalDate;
        $this->lastDate = $lastDate;
        $this->roleID = $roleID;
    }

    #prikazi sve nastavnike

    public static function getAll(mysqli $conn)
    {
        $query = "SELECT n.id,ime,prezime,datumOd,datumDo,z.naziv FROM nastavnik as n INNER JOIN zvanje as z ON n.zvanje_id=z.id";
        return $conn->query($query);
    }

    #nadji po id-u

    public static function getById($id, mysqli $conn){
        $query = "SELECT * FROM nastavnik WHERE id=$id";

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
        $query = "DELETE FROM nastavnik WHERE id=$this->id";
        return $conn->query($query);
    }

    #promeni profu
    public static function update(Professor $prof, mysqli $conn)
{
    $query = "UPDATE nastavnik SET ime = ?, prezime = ?, datumOd = ?, datumDo = ?, zvanje_id = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssii", $prof->name, $prof->lastname, $prof->initalDate, $prof->lastDate, $prof->roleID, $prof->id);
    return $stmt->execute();
}

    #dodaj profu
    public static function add(Professor $prof, mysqli $conn)
    {
        $query = "INSERT INTO nastavnik(ime, prezime, datumOd, datumDo,zvanje_id) VALUES('$prof->name','$prof->lastname','$prof->initalDate','$prof->lastDate','$prof->roleID')";
        return $conn->query($query);
    }
}

?>