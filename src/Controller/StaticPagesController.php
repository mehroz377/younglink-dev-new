<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ProfessionalHelp\ProfessionalHelpArticleRepository;
use App\Repository\ProfessionalHelp\ProfessionalHelpExpertRepository;
use App\Repository\ProfessionalHelp\ProfessionalHelpVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class StaticPagesController extends AbstractController
{
    private ProfessionalHelpVideoRepository $professionalHelpVideoRepository;
    private ProfessionalHelpExpertRepository $professionalHelpExpertRepository;
    private ProfessionalHelpArticleRepository $professionalHelpArticleRepository;

    public function __construct(
        ProfessionalHelpVideoRepository $professionalHelpVideoRepository,
        ProfessionalHelpExpertRepository $professionalHelpExpertRepository,
        ProfessionalHelpArticleRepository $professionalHelpArticleRepository,
    )
    {
        $this->professionalHelpVideoRepository = $professionalHelpVideoRepository;
        $this->professionalHelpExpertRepository = $professionalHelpExpertRepository;
        $this->professionalHelpArticleRepository = $professionalHelpArticleRepository;
    }

    #[Route(path: '/odborna-pomoc/video', name: 'app_professional_help_video')]
    public function videoPage(): Response
    {
        $videos = $this->professionalHelpVideoRepository->findAll();

        return $this->render('frontend/shared/odborna_pomoc_videa.html.twig', [
            'videos' => $videos,
        ]);
    }

    #[Route(path: '/odborna-pomoc/odbornici', name: 'app_professional_help_expert')]
    public function expertPage(): Response
    {
        $experts = $this->professionalHelpExpertRepository->findAll();

        return $this->render('frontend/shared/odborna_pomoc_odbornici.html.twig', [
            'experts' => $experts,
        ]);
    }

    #[Route(path: '/odborna-pomoc/clanky', name: 'app_professional_help_articles')]
    public function articlesPage(): Response
    {
        $articles = $this->professionalHelpArticleRepository->findAll();

        return $this->render('frontend/shared/odborna_pomoc_clanky.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route(path: '/odborna-pomoc/clanky/{slug}', name: 'app_professional_help_article_detail')]
    public function articleDetailPage(string $slug): Response
    {
        $article = $this->professionalHelpArticleRepository->findOneBy(['slug' => $slug]);

        if (!$article){
            return $this->redirectToRoute('app_professional_help_articles');
        }

        return $this->render('frontend/shared/odborna_pomoc_detail_clanku.html.twig', [
            'article' => $article,
        ]);
    }
}
