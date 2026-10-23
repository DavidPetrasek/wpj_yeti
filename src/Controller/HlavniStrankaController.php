<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class HlavniStrankaController extends AbstractController
{

    #[Route('/', methods: ['GET'], name: 'hlavni_stranka')]
    public function index(): Response
    {
       

        return $this->render('hlavni_stranka/index.html.twig', 
        [
            
        ]);
    }
}
