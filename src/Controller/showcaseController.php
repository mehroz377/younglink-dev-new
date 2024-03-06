<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class showcaseController extends AbstractController
{
    #[Route('/showcase')]
    public function __invoke(): Response
    {
        return $this->render('frontend/reports_showcase.html.twig', []);
    }
}
