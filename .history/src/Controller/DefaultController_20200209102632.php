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
        $user2 = new User;
        $user2->setName('Robert');
        $user3 = new User;
        $user3->setName('John');
        $user4 = new User;
        $user4->setName('Suzan');

        $entityManager->persist($user);
        $entityManager->persist($user2);
        $entityManager->persist($user3);
        $entityManager->persist($user4);
        exit($entityManager->flush());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            // 'users' => $users,
        ]);
    }

}
