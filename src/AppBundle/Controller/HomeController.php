<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Film;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function showAction(Request $request)
    {
        return $this->render('main/home.html.twig', [ 
            'films' => $this->getDoctrine()->getRepository(Film::class)->findAll(),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}