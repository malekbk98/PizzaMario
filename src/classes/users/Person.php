<?php
namespace classes\users;
use Data\Db;

abstract class Person
{
    public $fname, $lname, $email, $password, $birthday;

    /**
     * Construrctor:
     * Initiate person data 
     */
    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->birthday = $birthday;
    }

    /**
     * Function: CreateAccound
     * Description:
     *      - Automaticly mark person as logged in (when Admin/Chef create new account he will be automatically considererd as logged in)
     *      - Add initiated person to DB classe
     */
    public function createAccount()
    {
        $this->connected = true;
        Db::$accounts[] = $this;
        echo "account created!\n";
    }

    /**
     * Function: login
     * Description:
     *      - Verify login data and mark person as logged in or return error message in case of wrong data.
     */
    public function login($email, $password)
    {
        if ($this->connected) {
            echo "Already connected!\n";
        } else {
            if ($this->email === $email) {
                if (password_verify($password, $this->password)) {
                    $this->connected = true;
                    echo $this->fname ." ". $this->lname ." connected succefully!\n";
                }
            }
        }
    }

    /**
     * Function: logout
     * Description:
     *      - Mark person as logged out
     */
    public function logout()
    {
        if ($this->connected) {
            $this->connected = false;
            echo "disconnected successfully!\n";
        } else {
            echo "you have to be connected!\n";
        }
    }
}

?>