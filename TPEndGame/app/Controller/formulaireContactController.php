<?php

namespace Controller;

use Repository\formulaireRepository;
use Studoo\EduFramework\Core\Controller\ControllerInterface;
use Studoo\EduFramework\Core\Controller\Request;
use Studoo\EduFramework\Core\View\TwigCore;

class formulaireContactController implements ControllerInterface
{
    public function execute(Request $request): string|null
    {
        $confirmation = null;

        if ($request->get('nom')) {
            (new formulaireRepository())->inserFormulaire($request);
            $confirmation = "Merci pour votre message !";
        }

        return TwigCore::getEnvironment()->render('formulaire_contact/formulaire_contact.html.twig', [
            "titre" => $confirmation ? 'Formulaire envoyé' : 'Formulaire de contact',
            "confirmation" => $confirmation
        ]);
    }
}
