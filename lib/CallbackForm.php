<?php

/**
 * Created by PhpStorm.
 * User: artem
 * Date: 18.05.17
 * Time: 19:30
 */

require_once('FormAbstract.php');
require_once ('ShowMessageInterface.php');

class CallbackForm extends FormAbstract implements ShowMessageInterface
{
    protected $name;
    protected $phone;

    public function __construct(string $name, string $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    public function validate(): bool
    {
        if (empty($this->name) || strlen($this->name) > 20 || strlen($this->name) < 2) {
            return false;
        }
        if (empty($this->phone) || strlen($this->phone) < 7 || strlen($this->phone) > 15) {
            return false;
        }

        return true;
    }

    public function send()
    {
        echo 'Name: ' . $this->name;
        echo '<br>';
        echo 'Phone: ' . $this->phone;
    }

    public function showMessage()
    {
        echo '<br>';
        echo 'Form for calling back was opened';
    }
}