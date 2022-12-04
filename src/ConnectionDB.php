<?php
class ConnectionDB
{
    private static string $host;
    private static string $db;
    private static string $user; 
    private static string $pass;
    private static array $opts = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => true,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode='STRICT_ALL_TABLES'"
      ];

  public static function connect(string $host, string $db, string $user, string $pass) : object
  {
    self::$host = $host;
    self::$db = $db;
    self::$user = $user;
    self::$pass = $pass;

    $attr = "mysql:host=".self::$host.";dbname=".self::$db;
    $pdo = new PDO($attr, self::$user, self::$pass, self::$opts);
    $pdo->exec("CREATE TABLE IF NOT EXISTS Users(
      id INTEGER PRIMARY KEY AUTO_INCREMENT,
      fio varchar(100) NOT NULL,
      email varchar(40) NOT NULL,
      phone varchar(20) NOT NULL,
      `address` varchar(80) NOT NULL,
      UNIQUE(email)
      )");
    $pdo->exec("CREATE TABLE IF NOT EXISTS News(
      id INTEGER PRIMARY KEY AUTO_INCREMENT,
      title TEXT,
      `description` TEXT,
      `datetime` INTEGER
    )");
    return $pdo;
    }
}