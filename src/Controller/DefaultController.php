<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="default")
     */
    public function index(GiftsService $gifts, Request $request, SessionInterface $session)
    {
        // $users = [];
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        // exit($request->query->get('page', 'default'));
        exit($request->server->get('HTTP_HOST'));

        // exit($request->cookies->get('PHPSESSID'));

        // Sessions
        $session->set('name', 'session value');
        $session->remove('name');
        $session->clear();
        if($session->has('name'))
        {
            exit($session->get('name'));
        }

        // Create cookie
        $cookie = new Cookie(
            'my_cookie',
            'cookie value',
            time() + (2 * 365 * 24 * 60 * 60)
        );
        $res = new Response();
        $res->headers->setCookie( $cookie );
        $res->send();

        // Clear cookie 
        $res = new Response();
        $res->headers->clearCookie('my_cookie');

        // Flash messages
        $this->addFlash(
            'notice',
            'Your changes were saved'
        );

        $this->addFlash(
            'warning',
            'Your changes were saved'
        );


        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts -> gifts
        ]);
    }

    /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     */
    public function index2()
    {
        return new Response('Optional parameters in url and requirements for parameters.');
    }

    /**
     * @Route(
     *      "/articles/{_locale}/{year}/{slug}/{category}",
     *      defaults={"category" : "computers"},
     *      requirements={
     *          "_locale": "en|fr",
     *          "category": "computers|rtv",
     *          "year": "\d+"
     *      }
     * )
     */
     public function index3()
     {
         return new Response('An a advanced route example');
     }

     /**
      * @Route({
      *     "nl": "/over-ons", 
      *     "en": "/about-us"
      *
      *}, name="about_us")
      */
      public function index4() 
      {
        return new Response('Translated routes');
      }

}