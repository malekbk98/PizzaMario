<?php
namespace classes\users;

class Admin extends Person
{
    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday)
    {
        parent::__construct($fname,$lname,$email,$password,$birthday);
    }
}

?>