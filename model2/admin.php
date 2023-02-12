<?php

class Admin{
    public $id;
    public $username;
    public $password;

    public function __construct($id=null,$username=null,$password=null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public static function logAdmin($ad, mysqli $conn)
    {
        $query = "SELECT * FROM adminT WHERE username='$ad->username' and password='$ad->password'";
        return $conn->query($query);
    }
}


?>