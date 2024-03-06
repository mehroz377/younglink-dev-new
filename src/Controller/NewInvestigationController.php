<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class NewInvestigationController extends AbstractController
{
    #[Route('/nove-setreni')]
    public function __invoke(): Response
    {
        return $this->render('frontend/new_investigation.html.twig', []);
    }
}
