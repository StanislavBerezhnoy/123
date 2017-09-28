<?php

require_once('CallbackForm.php');
require_once('ShowMessageInterface.php');

const PDF_FILE_SIZE = 1024 * 5 * 1024;

class SendBidForm extends CallbackForm implements ShowMessageInterface
{
    protected $email;


    public function __construct(string $name, string $phone, string $email)
    {
        parent::__construct($name, $phone);
        $this->email = $email;
    }

    public function validate(): bool
    {
        parent::validate();


        if ($this->email == !'') {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
        } elseif ($this->email == null) {
            $this->email = 'Mail not specified';
            return true;
        }

        if ($_FILES["newFile"]["size"] > PDF_FILE_SIZE || $_FILES["newFile"]["type"] != "application/pdf") {
            echo "Error";
            echo '<br>';
            unset($_FILES["newFile"]["name"]);
        } else {
            if (is_uploaded_file($_FILES["newFile"]["tmp_name"])) {
                if (is_dir("file")) {
                    move_uploaded_file($_FILES["newFile"]["tmp_name"], "files/" . $_FILES["newFile"]["name"]);
                } else {
                    mkdir("files", 0777);
                    move_uploaded_file($_FILES["newFile"]["tmp_name"], "files/" . $_FILES["newFile"]["name"]);
                }
            } else {
                echo '<br>';
                echo 'Error';
                unset($_FILES["newFile"]["name"]);
            }
        }
        return true;
    }


    public function send()
    {
        parent::send();
        echo '<br>';
        echo 'Email: ' . $this->email;
    }

    public function showMessage()
    {
        echo '<br>';
        echo 'Form for sending a bid was opened';
    }
}
