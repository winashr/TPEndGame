<?php

namespace Controller;

use Entity\formulaireEntity;
use Repository\formulaireRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;

class formulaireContactController implements ControllerInterface
{
    public function execute(Request $request): string|null
    {
        // Si la requête contient un champ 'nom', on considère que c'est un POST
        if (!empty($request->get('nom'))) {
            $nom     = $request->get('nom');
            $email   = $request->get('email');
            $sujet   = $request->get('sujet');
            $message = $request->get('message');

            $formulaire = new formulaireEntity($nom, $email, $sujet, $message);
            (new formulaireRepository())->save($formulaire);

            return TwigCore::getEnvironment()->render('formulaire_contact/formulaire_contact.html.twig', [
                "titre" => 'Formulaire envoyé',
                "confirmation" => "Merci pour votre message !"
            ]);
        }

        // Sinon, juste afficher le formulaire
        return TwigCore::getEnvironment()->render('formulaire_contact/formulaire_contact.html.twig', [
            "titre" => 'Formulaire de contact'
        ]);
    }
}
