<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\StatistikaHodnoceniService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StatistikaHodnoceniController extends AbstractController
{
    #[Route('/statistika-hodnoceni', name: 'statistika_hodnoceni', methods: ['GET'])]
    public function index(StatistikaHodnoceniService $statistikaHodnoceniService): Response
    {
        return $this->render('statistika_hodnoceni/index.html.twig', [
            'mesicniPrehled' => $statistikaHodnoceniService->mesicniPrehled(),
            'pocetYeti' => $statistikaHodnoceniService->pocetYeti(),
            'hodnoceniPocet' => $statistikaHodnoceniService->hodnoceniPocet(),
        ]);
    }
}
