<?php

namespace Repository;

use Entity\formulaireEntity;
use Studoo\EduFramework\Core\Service\DatabaseService;
use Studoo\EduFramework\Core\Controller\Request;


class formulaireRepository
{
    public function save(formulaireEntity $formulaire): void
    {
        $pdo = DatabaseService::getConnect();

        $stmt = $pdo->prepare("INSERT INTO messages (nom, email, sujet, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $formulaire->getNom(),
            $formulaire->getEmail(),
            $formulaire->getSujet(),
            $formulaire->getMessage()
        ]);
    }
    public function inserFormulaire(Request $request): void
    {
        $formulaire = new \Entity\formulaireEntity(
            $request->get('nom'),
            $request->get('email'),
            $request->get('sujet'),
            $request->get('message')
        );

        $this->save($formulaire);
    }

}
