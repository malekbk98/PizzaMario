<?php
namespace users\personne;

class Admin extends Personne
{
    public function __construct(string $nom)
    {
        parent::__construct($nom);
    }
}

?>