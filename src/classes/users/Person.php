<?php
namespace classes\users;

abstract class Person
{
    public $fname, $lname, $email, $password, $birthday;

    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->birthday = $birthday;
    }
}

?>