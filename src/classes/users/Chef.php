<?php
namespace users\personne;

class Chef extends Personne
{
    public $dateEmbauche;

    public function __construct(string $nom)
    {
        parent::__construct($nom);
    }
}

?>