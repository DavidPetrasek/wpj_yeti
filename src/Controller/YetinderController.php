<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\YetiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class YetinderController extends AbstractController
{
    #[Route('/yetinder', name: 'yetinder', methods: ['GET'])]
    public function index(YetiService $yetiService): Response
    {
        $yeti = $yetiService->vyberNahodneho();

        return $this->render('yetinder/index.html.twig', [
            'yetiId' => $yeti?->getId(),
        ]);
    }
}
