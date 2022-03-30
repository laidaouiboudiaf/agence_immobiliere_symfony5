<?php

namespace App\Controller;

use App\Repository\OwnersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{


    /**
     * @Route("/" , name="home")
     * 
     */
    public function index(OwnersRepository $ownersRepository): Response
    {
        $properties= $ownersRepository->findAll();
        $numberAnnounces= $ownersRepository->totalOwners();

        return $this->render('index.html.twig', [
            'properties' => $properties,
            'numberAnnounces'=> $numberAnnounces
        ]);
    }
}
