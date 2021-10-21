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
        echo "account created! <br>";
    }

    /**
     * Function: login
     * Description:
     *      - Verify login data and mark person as logged in or return error message in case of wrong data.
     */
    public function login($email, $password)
    {
        if ($this->connected) {
            return "Already connected!<br>";
        } else {
            if ($this->email === $email) {
                if (password_verify($password, $this->password)) {
                    $this->connected = true;
                    echo $this->fname . " " . $this->lname . " connected succefully!<br>";
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
            echo "disconnected successfully!<br>";
        } else {
            echo "you have to be connected!<br>";
        }
    }

    /**
     * Function: changeData
     * Description:
     *      - Update person email
     *      - Update person first name (fname)
     *      - Update person last name (lname)
     *      - Update person birthday
     */
    public function changeData($fname, $lname, $email, $password, $birthday)
    {
        if ($this->connected) {
            if (password_verify($password, $this->password)) {
                $this->fname = $fname;
                $this->lname = $lname;
                $this->email = $email;
                $this->birthday =$birthday;
                echo "Data changed succefully!<br>";
            } else {
                echo "Ops! wrong password! <br>";
            }
        } else {
            echo "Ops! you need to login! <br>";
        }
    }
}

?>
