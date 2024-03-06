<?php

declare(strict_types=1);

namespace App\Controller\SchoolEmployee;

use App\Entity\Classroom;
use App\Entity\Timeline;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SchoolEmployeeTimelineController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/zamestnanec-skoly/trida/{id}/casova-osa/{timeline}', name: 'app_school_employee_timeline')]
    public function __invoke(Classroom $classroom, Timeline $timeline): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $schoolEmployee = $user->getSchoolEmployee();

        return $this->render('frontend/school_employee/school_employee_timeline.html.twig', [
            'school_employee' => $schoolEmployee,
            'classroom' => $classroom,
            'timeline' => $timeline,
        ]);
    }
}
