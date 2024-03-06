<?php

declare(strict_types=1);

namespace App\Controller\SchoolEmployee;

use App\Entity\Classroom;
use App\Entity\Questionnaire;
use App\Entity\Timeline;
use App\Entity\User;
use App\Form\QuestionnaireType;
use App\Repository\QuestionnaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SchoolEmployeeCreateQuestionnaireController extends AbstractController
{
    private QuestionnaireRepository $questionnaireRepository;

    public function __construct(QuestionnaireRepository $questionnaireRepository)
    {
        $this->questionnaireRepository = $questionnaireRepository;
    }

    #[Route(path: '/zamestnanec-skoly/trida/{id}/casova-osa/{timeline}/nove-setreni', name: 'app_school_employee_timeline_create_questionnaire')]
    public function __invoke(Classroom $classroom, Timeline $timeline, Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $schoolEmployee = $user->getSchoolEmployee();

        $questionnaire = new Questionnaire();
        $form = $this->createForm(QuestionnaireType::class,$questionnaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // map questionnaire
            $questionnaire->setTimeline($timeline);
        }

        return $this->render('frontend/school_employee/school_employee_create_questionnaire.html.twig', [
            'school_employee' => $schoolEmployee,
            'classroom' => $classroom,
            'timeline' => $timeline,
            'form' => $form->createView(),
        ]);
    }
}
