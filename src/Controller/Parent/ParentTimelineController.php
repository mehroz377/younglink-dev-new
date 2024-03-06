<?php

declare(strict_types=1);

namespace App\Controller\Parent;

use App\Entity\Student;
use App\Entity\Timeline;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ParentTimelineController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/rodic/student/{id}/casova-osa/{timeline}', name: 'app_parent_timeline')]
    public function __invoke(Student $student, Timeline $timeline): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $guardian = $user->getGuardian();

        return $this->render('frontend/parent/parent_timeline.html.twig', [
            'guardian' => $guardian,
            'student' => $student,
            'timeline' => $timeline,
        ]);
    }
}
