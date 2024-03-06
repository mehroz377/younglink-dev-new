<?php

declare(strict_types=1);

namespace App\Controller\Parent;

use App\Entity\MainMessage;
use App\Entity\Student;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ParentMessageDetailController extends AbstractController
{
    #[Route(path: '/rodic/student/{id}/zpravy/{message}', name: 'app_parent_message_detail')]
    public function __invoke(Student $student, MainMessage $mainMessage): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $guardian = $user->getGuardian();

        return $this->render('frontend/parent/parent_messages_detail.html.twig', [
            'guardian' => $guardian,
            'student' => $student,
            'mainMessage' => $mainMessage,
        ]);
    }
}
