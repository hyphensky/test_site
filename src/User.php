<?php
class User
{
    public string $fio;
    public string $email;
    public string $phone;
    public string $address;

    function __construct(
      string $fio, 
      string $email, 
      string $phone, 
      string $address, 
    ) {
      $this->fio = $fio;
      $this->email = $email;
      $this->phone = $phone;
      $this->address = $address;
    }

    public function addUser($pdo) : void
    {
      $sql = "INSERT INTO Users VALUES (NULL,?,?,?,?)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
        $this->fio,  
        $this->email, 
        $this->phone, 
        $this->address,
      ]);
    }

}