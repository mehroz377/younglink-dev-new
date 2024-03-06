<?php

declare(strict_types=1);

namespace App\Controller\SchoolEmployee;

use App\Entity\User;
use App\Repository\MainMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SchoolEmployeeMessageController extends AbstractController
{
    private MainMessageRepository $mainMessageRepository;

    public function __construct(MainMessageRepository $mainMessageRepository)
    {
        $this->mainMessageRepository = $mainMessageRepository;
    }

    #[Route(path: '/zamestnanec-skoly/zpravy', name: 'app_school_employee_messages')]
    public function __invoke(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $schoolEmployee = $user->getSchoolEmployee();

        $messages = $this->mainMessageRepository->findByUser($user);

        return $this->render('frontend/school_employee/school_employee_messages.html.twig', [
            'schoolEmployee' => $schoolEmployee,
            'messages' => $messages,
        ]);
    }
}
