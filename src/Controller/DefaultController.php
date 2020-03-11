<?php

namespace App\Controller;

use App\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Video;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{

    public function __construct($logger)
    {

    }

    /**
     * @Route("/", name="default", name="home")
     */
    public function index(Request $request)
    {

        $entityManager = $this -> getDoctrine() -> getManager();

//        $user = new User();
//        $user->setName('Robert');
//
//        for($i=1; $i<=3; $i++)
//        {
//            $video = new Video();
//            $video->setTitle('Video tile' . $i);
//            $user->addVideo($video);
//            $entityManager->persist($video);
//        }
//
//        $entityManager->persist($user);
//        $entityManager->flush();


        $user = $entityManager->getRepository(User::class)->findWithVideos(1);

        dump($user);

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
//            'users' => $user1->getFollowing()->count()
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

      /**
       * @Route("/generate-url/{param?}", name="generate_url")
       */
      public function generate_url()
      {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
      }

      /**
       * @Route("/download")
       */
      public function download()
      {
          $path = $this->getParameter('download_directory');
          return $this->file($path.'file.pdf');
      }

      /**
       * @Route("/redirect-test")
       */
      public function redirectTest()
      {
          return $this->redirectToRoute('route_to_redirect', array('param' => 10));
      }

      /**
       * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
       */
      public function methodToRedirect()
      {
          exit("Test redirection");
      }

      /**
       * @Route("/forwarding-to-controller")
       */
      public function forwardingToController()
      {
          $response = $this -> forward(
              'App\Controller\DefaultController::methodToForwardTo',
              array('param' => '1')
          );

          return $response;
      }

      /**
       * @Route("/url-to-forward-to/{param?}", name="route_to_forward_to")
       */
      public function methodToForwardTo($param)
      {
          exit('Test controller forwarding - ' . $param);
      }
}