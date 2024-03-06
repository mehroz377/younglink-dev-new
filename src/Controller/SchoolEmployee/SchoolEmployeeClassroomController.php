<?php

declare(strict_types=1);

namespace App\Controller\SchoolEmployee;

use App\Entity\Classroom;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SchoolEmployeeClassroomController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/zamestnanec-skoly/trida/{id}', name: 'app_school_employee_classroom')]
    public function __invoke(Classroom $classroom): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $schoolEmployee = $user->getSchoolEmployee();

        return $this->render('frontend/school_employee/school_employee_classroom.html.twig', [
            'school_employee' => $schoolEmployee,
            'classroom' => $classroom,
        ]);
    }
}
