<?php

include 'src/Database.php';

class User
{
    private $firstname;
    private $lastname;
    private $email;
    private $password;

    // Setters
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Getters
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // Sprawdz czy user istnieje w bazie
    public function checkUserExistByEmail($user)
    {
        $db = new Database;
        $db->dbConnect();

        $email = $user->getEmail();

        // Wybierz pole email z tabeli users, gdzie email jest taki jak podany w formularzu
        $sql = "SELECT email FROM users WHERE email = '$email'";

        $result = $db->dbQuery($sql);

        // Zwraca liczbe wierszy, po wykonaniu zapytania
        $row = mysqli_num_rows($result); 

        // Jesli rekord istnieje zwroc TRUE, jesli nie zwroc FALSE
        if ($row > 0) {
            return true;
        } else
            return false;
    }


    public function registerUser($user)
    {
        $db = new Database;
        $db->dbConnect();

        //$unserializadUsed = unserialize($user);
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $email = $user->getEmail();
        $password = $user->getPassword();


        //return var_dump($firstname, $lastname, $email, $password );
        //$db->dbCreate();
        //$db->dbDelete();
        //$db->checkConnection();





        // sql to create table
        /*
        $sql = "CREATE TABLE users (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                email VARCHAR(50),
                password VARCHAR(200)
                )";

        */
        $sql = "INSERT INTO users (
                firstname, 
                lastname, 
                email, 
                password
                ) VALUES (
                    '$firstname', 
                    '$lastname', 
                    '$email', 
                    '$password'
                    )";

        $db->dbInsert($sql);
        $db->dbConnectClose();
    }
}
