<?php
namespace users\personne;

abstract class Personne
{
    public $nom, $prenom, $email, $password, $dateNaiss;

    public function __construct(string $nom)
    {
        $this->nom = $nom;
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