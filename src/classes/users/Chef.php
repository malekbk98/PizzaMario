<?php
namespace classes\users;

class Chef extends Person
{
    public $dateEmbauche;

    public function __construct(string $fname, string $lname, string $email, string $password, string $birthday, string $dateEmbauche)
    {
        $this->dateEmbauche=$dateEmbauche;
        parent::__construct($fname,$lname,$email,$password,$birthday);
    }
}

?>