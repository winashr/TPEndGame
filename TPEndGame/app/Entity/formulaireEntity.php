<?php

namespace Entity;

class formulaireEntity
{
    private string $nom;
    private string $email;
    private string $sujet;
    private string $message;

    public function __construct(string $nom, string $email, string $sujet,string $message)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->sujet = $sujet;
        $this->message = $message;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getSujet(): string
    {
        return $this->sujet;
    }

    public function getMessage(): string{
        return $this->message;
    }

}
