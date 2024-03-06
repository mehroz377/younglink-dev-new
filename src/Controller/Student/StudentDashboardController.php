<?php

declare(strict_types=1);

namespace App\Controller\Student;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

final class StudentDashboardController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/student/', name: 'app_student_dashboard')]
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $student = $user->getStudent();

        return $this->render('frontend/student/student_dashboard.html.twig', [
            'student' => $student,
        ]);
    }
}
