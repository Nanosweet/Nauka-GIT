<?php


class Database
{

  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbName = "timezone";
  private $conn;

  // Laczenie z baza danych
  public function dbConnect()
  {

    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbName);
  
    if ($this->conn->connect_error) {
      die("Nie udało sie połączyć z bazą danych: " . $this->conn->connect_error);
    } else {
      return $this->conn;
    }

    
  }

  // Zamykanie polaczenia z baza danych
  public function dbConnectClose()
  {
    $this->conn->close();
  }

  // Sprawdzanie, czy polaczenie z baza danych jest aktywne
  public function checkConnection()
  {
    if ($this->conn->ping()) {
      printf("Połączenie z DB jest aktywne!");
    } else {
      printf("Polączenie z DB jest zakmniete", $this->conn->error);
    }
  }

  // Tworzenie bazy danych
  public function dbCreate()
  {
    $sql = 'CREATE DATABASE timezone';

    if($this->conn->query($sql))
    {
      echo 'Pomyślnie utworzono baze danych';
    } else {
      echo 'jakis kurwa blad';
    }
  }

  // Dodawanie danych
  public function dbInsert($query)
  {
    if ($this->conn->query($query) === TRUE) {
      echo "Wykonano zapytanie";
  } else {
      echo "Error creating table: " . $this->conn->error;
  }
  }

  // Wykonanie zapytan
  public function dbQuery($query)
  {
    $result = $this->conn->query($query);

    return $result;
  }
  

  // Tworzenie tabeli
  public function dbCreateTable($tablename)
  {
    $sql = "CREATE TABLE '$tablename'";
  }

  // Usuwanie bazy danych
  public function dbDelete()
  {
    $sql = 'DROP DATABASE timezone';

    if(!$this->conn->query($sql) === TRUE)
    {
      echo 'Error';
    } else {
      echo 'Baza usunięta pomyślnie \n';
    }
  }



}
