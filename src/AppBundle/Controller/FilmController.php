<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Film;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $token = $this->get('security.token_storage')->getToken();
        if ($token === null) {
            return $this->render('main/film.html.twig', [ 
                'film' => $this->getDoctrine()->getRepository(Film::class)->find($filmId),
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            ]);
        }

        try {
            $requestfilmId = $request->query->get('filmId');
            $authentificatedUser = $this->get('security.token_storage')->getToken()->getUser();
            $userId = $this->get('security.token_storage')
                ->getToken()
                ->getUser()
                ->getId();

            $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($userId);
            $film = $this->getDoctrine()->getManager()->getRepository(Film::class)->find($requestfilmId);
            $user->addFilm($film);
            $film->addUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($film);
            $em->flush();

            return new JsonResponse($film->jsonSerialize());
        } catch(Exception $ex) {
            return $this->render('main/film.html.twig', [ 
                'film' => $this->getDoctrine()->getRepository(Film::class)->find($filmId),
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            ]);
        }
    }
}