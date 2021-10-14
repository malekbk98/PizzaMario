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
        $this->password = $password;
        $this->birthday = $birthday;
    }

    public function __toString()
    {
        return json_encode($this);
    }

    public function __set(string $name, $value)
    {
        $this->$name = $value;
    }

    public function __get(string $name)
    {
        return $this->$name;
    }
}

?>