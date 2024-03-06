<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class LoginController extends AbstractController
{
    #[Route('/login')]
    public function __invoke(): Response
    {
        return $this->render('frontend/login.html.twig', []);
    }
}
