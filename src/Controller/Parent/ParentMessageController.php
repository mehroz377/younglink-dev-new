<?php

declare(strict_types=1);

namespace App\Controller\Parent;

use App\Entity\Student;
use App\Entity\Timeline;
use App\Entity\User;
use App\Repository\MainMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ParentMessageController extends AbstractController
{
    private MainMessageRepository $mainMessageRepository;

    public function __construct(MainMessageRepository $mainMessageRepository)
    {
        $this->mainMessageRepository = $mainMessageRepository;
    }

    #[Route(path: '/rodic/student/{id}/zpravy', name: 'app_parent_messages')]
    public function __invoke(Student $student): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $guardian = $user->getGuardian();

        $messages = $this->mainMessageRepository->findByUser($user);

        return $this->render('frontend/parent/parent_messages.html.twig', [
            'guardian' => $guardian,
            'student' => $student,
            'messages' => $messages,
        ]);
    }
}
