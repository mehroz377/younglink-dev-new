<?php

declare(strict_types=1);

namespace App\Controller\SchoolEmployee;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SchoolEmployeeDashboardController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/zamestnanec-skoly/', name: 'app_school_employee')]
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $schoolEmployee = $user->getSchoolEmployee();

        return $this->render('frontend/school_employee/school_employee_dashboard.html.twig', [
            'school_employee' => $schoolEmployee,
        ]);
    }
}
