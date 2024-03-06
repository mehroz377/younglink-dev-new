<?php

declare(strict_types=1);

namespace App\Controller\Results;

use App\Entity\Questionnaire;
use App\Entity\Student;
use App\Entity\User;
use App\Repository\StudentResultsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class StudentResultsController extends AbstractController
{
    private StudentResultsRepository $studentResultsRepository;

    public function __construct(StudentResultsRepository $studentResultsRepository)
    {
        $this->studentResultsRepository = $studentResultsRepository;
    }

    #[Route(path: '/setreni/{questionnaire}/vysledky/student/{student}', name: 'app_student_result')]
    public function __invoke(Questionnaire $questionnaire, Student $student): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();

//        if (!$user){
//            return $this->redirectToRoute('app_homepage');
//        }

        $studentResult = $this->studentResultsRepository->findOneBy(['student' => $student],['createdAt' => 'DESC']);

        return $this->render('frontend/psycholog_pohled_zaka.html.twig', [
                'result' => $studentResult,
            ]);

        if ($user->hasRole("ROLE_DIRECTOR")){
            return $this->render('frontend/reditel/reditel_detail_reportu.html.twig', [
                'result' => $studentResult,
            ]);
        }

        if ($user->hasRole("ROLE_PSYCHOLOGIST")){
            return $this->render('frontend/psycholog/psycholog_pohled_zaka.html.twig', [
                'result' => $studentResult,
            ]);
        }

        if ($user->hasRole("ROLE_TEACHER")){
            return $this->render('frontend/ucitel/ucitel_detail_reportu_zak.html.twig', [
                'result' => $studentResult,
            ]);
        }

        if ($user->hasRole("ROLE_PARENT")){
            return $this->render('frontend/rodic/rodic_detail_reportu.html.twig', [
                'result' => $studentResult,
                'classResult' => $studentResult?->getResults(),
            ]);
        }

        if ($user->hasRole("ROLE_STUDENT")){
            return $this->render('frontend/zak/zak_detail_reportu.html.twig', [
                'result' => $studentResult?->getResults(),
            ]);
        }

        return $this->redirectToRoute('app_homepage');
    }
}
