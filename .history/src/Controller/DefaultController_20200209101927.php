<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        // $users = ['Adam', 'Robert', 'John', 'Susan'];

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User;
        $user->setName('Adam');
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
        ]);
    }

}
