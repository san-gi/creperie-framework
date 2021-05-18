<?php

namespace App\Controller;

use App\Entity\Crepe;
use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="front")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/crepes", name="crepes")
     */
    public function crepes(): Response
    {
        $crepes = $this->getDoctrine()->getRepository(Crepe::class)->findAll();
        return $this->render('front/crepes.html.twig', [
            'controller_name' => 'FrontController',
            'crepes' => $crepes

        ]);
    }
}
