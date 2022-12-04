<?php
class Validator
{
  public function validFIO(string $val) : string
  {
    $res = preg_match('/^[а-яё\'-]+\s[а-яё\'-]+\s[а-яё\'-]+/ui', $val);
    if (!$res) {
      return "Некорректное ФИО";
    } else {
      return "";
    }
  }

  public function validMail($pdo, string $val) : string
  { 
   $mail = $pdo->quote($val);
   $res = $pdo->query("SELECT COUNT(*) FROM Users WHERE email = $mail")->fetchColumn();
   if ($res > 0 && !isset($logged)) {
      return "Выберите другой e-mail";
   }
   
   if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
      return "";
   } else {
      return "Некорректный адрес e-mail";
   }
  }

  public function validPhone(string $val) : string
  {
    $regexp = "/^[-\s\(\)]*(8|\+7|\+ 7)([-\s\(\)]*[\d][-\s\(\)]*){10}$/ui";
    $res = preg_match($regexp, $val);
    if (!$res) {
        return "Некорректный номер телефона";
    } else {
        return "";
    }
  }

  public function validAddress(string $val) : string
  {
    $res = preg_match('/^[а-яё\s,.]+\d+/ui', $val);
    if (!$res) {
      return "Некорректный адрес";
    } else {
      return "";
    }
  }
}