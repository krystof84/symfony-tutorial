<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\GiftsService;

class DefaultController extends AbstractController
{
    public function __construct(GiftsService $gifts)
    {
        
    }


    /**
     * @Route("/", name="default")
     */
    public function index(GiftsService $gifts)
    {
        // $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts -> gifts
        ]);
    }

}
