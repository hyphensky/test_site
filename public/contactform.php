<?php
require "../header.php";

$fio = $phone = $address = $email = "";
$regString = "";
$validation = false;
$error = $userArr = array();
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $fio = $_POST['fio'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    $val = new Validator();
    $error['fio'] = $val->validFIO($fio);
    $error['email'] = $val->validMail($pdo, $email);
    $error['phone'] = $val->validPhone($phone);
    $error['address'] = $val->validAddress($address);
    foreach($error as $err) {
        if ($err != "") {
            $validation = false;
            break;
        } else {
            $validation = true;
        }
    }
    if (!$validation) {
        $regString = "Ошибка, исправьте данные";
    } else {
        $user = new User($fio, $email, $phone, $address);
        $user->addUser($pdo);
        $regString = "Данные были успешно отправлены";
        $user = (array) $user;
    } 
}
$obj = new User($fio, $email, $phone, $address);
$user = (array) $obj;

include '../views/contactform.phtml';
