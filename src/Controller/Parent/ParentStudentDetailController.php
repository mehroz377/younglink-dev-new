<?php

declare(strict_types=1);

namespace App\Controller\Parent;

use App\Entity\Student;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ParentStudentDetailController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/rodic/student/{id}', name: 'app_parent_student_detail')]
    public function __invoke(Student $student): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $guardian = $user->getGuardian();

        return $this->render('frontend/parent/parent_student_detail.html.twig', [
            'guardian' => $guardian,
            'student' => $student,
        ]);
    }
}
