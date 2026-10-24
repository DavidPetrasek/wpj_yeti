<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PridaniYetihoController extends AbstractController
{
    #[Route('/pridat-yetiho', name: 'pridani_yetiho', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pridani_yetiho/index.html.twig');
    }
}
