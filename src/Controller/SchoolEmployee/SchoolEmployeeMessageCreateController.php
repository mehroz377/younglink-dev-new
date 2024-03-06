<?php

declare(strict_types=1);

namespace App\Controller\SchoolEmployee;

use App\Entity\MainMessage;
use App\Entity\SubMessage;
use App\Entity\User;
use App\Form\SubMessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SchoolEmployeeMessageCreateController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route(path: '/zamestnanec-skoly/zpravy/vytvorit', name: 'app_school_employee_messages_create')]
    public function __invoke(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $schoolEmployee = $user->getSchoolEmployee();

        $form = $this->createForm(SubMessageType::class,null);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // map messages
            $data = $form->getData();

            $subMessage = new SubMessage();
            $subMessage->setFrom($user);
            $subMessage->setMessageText($data->messageText);

            $mainMessage = new MainMessage();
            $mainMessage->setTo($data->target);
            $mainMessage->setFrom($user);
            $mainMessage->addMessage($subMessage);

            $this->entityManager->persist($subMessage);
            $this->entityManager->persist($mainMessage);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_school_employee_messages');
        }

        return $this->render('frontend/school_employee/school_employee_create_message.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
