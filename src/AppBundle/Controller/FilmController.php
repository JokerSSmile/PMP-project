<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Film;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{
    /**
     * @Route("/film", name="film")
     */
    public function showAction(Request $request)
    {
        $filmId = $request->query->get('id');
        
        return $this->render('main/film.html.twig', [ 
            'film' => $this->getDoctrine()->getRepository(Film::class)->find($filmId),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function subscribeAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $filmId = $request->query->get('id');

        
        
        if ($user == null) {
            return $this->render('main/film.html.twig', [ 
                'film' => $this->getDoctrine()->getRepository(Film::class)->find($filmId),
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                'success' => false
            ]);
        }
        return $this->render('main/film.html.twig', [ 
            'film' => $this->getDoctrine()->getRepository(Film::class)->find($filmId),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'success' => true
        ]);
    }
}