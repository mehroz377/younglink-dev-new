<?php

declare(strict_types=1);

namespace App\Controller\Results;

use App\Entity\Questionnaire;
use App\Entity\User;
use App\Repository\QuestionnaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

final class ClassResultsController extends AbstractController
{
    #[Route(path: '/setreni/{id}/vysledky', name: 'app_class_results')]
    public function __invoke(Questionnaire $questionnaire): Response
    {
        return $this->render('frontend/psycholog/psycholog_tridni_zobrazeni.html.twig', [
                'result' => $questionnaire->getResults(),
            ]);

        /** @var User|null $user */
        $user = $this->getUser();

        if (!$user){
            return $this->redirectToRoute('app_homepage');
        }

        if ($user->hasRole("ROLE_DIRECTOR")){
            return $this->render('frontend/ucitel/ucitel_detail_reportu_trida.html.twig', [
                'result' => $questionnaire->getResults(),
            ]);
        }

        if ($user->hasRole("ROLE_PSYCHOLOGIST")){
            return $this->render('frontend/psycholog/psycholog_tridni_zobrazeni.html.twig', [
                'result' => $questionnaire->getResults(),
            ]);
        }

        if ($user->hasRole("ROLE_TEACHER")){
            return $this->render('frontend/ucitel/ucitel_detail_reportu_trida.html.twig', [
                'result' => $questionnaire->getResults(),
            ]);
        }

        return $this->redirectToRoute('app_homepage');
    }
}
