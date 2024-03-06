<?php

declare(strict_types=1);

namespace App\Controller\SchoolEmployee;

use App\Entity\MainMessage;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SchoolEmployeeMessageDetailController extends AbstractController
{
    #[Route(path: '/zamestnanec-skoly/zpravy/{id}', name: 'app_parent_message_detail')]
    public function __invoke(MainMessage $mainMessage): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $schoolEmployee = $user->getSchoolEmployee();

        return $this->render('frontend/school_employee/school_employee_messages_detail.html.twig', [
            'schoolEmployee' => $schoolEmployee,
            'mainMessage' => $mainMessage,
        ]);
    }
}
