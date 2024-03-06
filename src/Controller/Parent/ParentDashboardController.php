<?php

declare(strict_types=1);

namespace App\Controller\Parent;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ParentDashboardController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route(path: '/rodic/', name: 'app_parent_dashboard')]
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $guardian = $user->getGuardian();

        return $this->render('frontend/parent/parent_dashboard.html.twig', [
            'guardian' => $guardian,
            'students' => $guardian?->getStudents(),
        ]);
    }
}
