<?php
namespace classes\users;
use Data\Db;

abstract class Person
{
    public $fname, $lname, $email, $password, $birthday, $access;

    /**
     * Access:
     * 200: Admin
     * 100: Chef 
     */


    /**
     * Construrctor:
     * Initiate person data
     */
    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday, string $access)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->birthday = $birthday;
        $this->access = $access;
    }

    /**
     * Function: CreateAccound
     * Description:
     *      - Automaticly mark person as logged in (when Admin/Chef create new account he will be automatically considererd as logged in)
     *      - Add initiated person to DB classe
     */
    public function createAccount()
    {
        $_SESSION['user']=$this->email;
        $_SESSION['access']=$this->access;
        DB::$accounts[] = $this;
        echo "account created! \n";
    }

    /**
     * Function: login
     * Description:
     *      - Verify login data and mark person as logged in or return error message in case of wrong data.
     */
    public function login($email, $password)
    {
        if (isset($_SESSION['user'])) {
            return "Already connected!\n";
        } else {
            if ($this->email === $email) {
                if (password_verify($password, $this->password)) {
                    $_SESSION['user']=$email;
                    $_SESSION['access']=$this->access;
                    echo $this->fname . " " . $this->lname . " connected succefully!\n";
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
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            unset($_SESSION['access']);
            echo "disconnected successfully!\n";
        } else {
            echo "you have to be connected!\n";
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
        if (isset($_SESSION['user'])) {
            if (password_verify($password, $this->password)) {
                $this->fname = $fname;
                $this->lname = $lname;
                $this->email = $email;
                $this->birthday = $birthday;
                echo "Data changed succefully!\n";
            } else {
                echo "Ops! wrong password! \n";
            }
        } else {
            echo "Ops! you need to login! \n";
        }
    }

    /**
     * Function: changePassword
     * Description:
     *      - Update person password
     */
    public function changePassword($oldPassword, $newPassword)
    {
        if (isset($_SESSION['user'])) {
            if (password_verify($oldPassword, $this->password)) {
                $this->password = password_hash($newPassword, PASSWORD_DEFAULT);
                echo "Password changed succefully! \n";
            } else {
                echo "Ops! wrong password! \n";
            }
        } else {
            echo "Ops! you need to login! \n";
        }
    }

    /**
     * Function: forgetPassword
     * Description:
     *      - Reset password
     */
    public function forgetPassword($email, $emailCode, $newPassword)
    {
        if (!isset($_SESSION['user'])) {
            //Person should be logged out
            if ($this->email === $email) {
                //Just for testing (the email code should be generated auto and sent by email/sms)
                if ($emailCode === "12345") {
                    $this->password = password_hash($newPassword, PASSWORD_DEFAULT);
                    echo "Password changed succefully! \n";
                } else {
                    echo "Ops! wrong code! \n";
                }
            } else {
                echo "Ops! wrong email! \n";
            }
        } else {
            //In case person is already logged in
            echo "Ops! you can't access this page, you're already logged in, please use your profile setting to change your password! \n";
        }
    }
}

?>
