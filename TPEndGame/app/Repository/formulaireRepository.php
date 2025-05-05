<?php

namespace Repository;

use Entity\formulaireEntity;
use Studoo\EduFramework\Core\Service\DatabaseService;

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
}
