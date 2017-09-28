<?php
/**
 * Created by PhpStorm.
 * User: artem
 * Date: 18.05.17
 * Time: 19:40
 */
require_once('lib/CallbackForm.php');
require_once('lib/SendBidForm.php');

$name = trim($_POST['name']) ?? '';
$phone = trim($_POST['phone']) ?? '';
$email = trim($_POST['email']) ?? '';
$formType = trim($_POST['formType']) ?? '';

switch ($_POST["formType"]) {
    case "callback":
        $form = new CallbackForm($name, $phone);
        break;
    case "sendBid":
        $form = new SendBidForm($name, $phone, $email);
        break;
}

if ($form->validate()) {
    $form->send();
    $form->showMessage();
} else {
    echo 'Введите корректные данные';
}

