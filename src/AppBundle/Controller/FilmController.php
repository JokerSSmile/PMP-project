<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Film;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class FilmController extends Controller
{
    /**
     * @Route("/film", name="film")
     */
    public function showAction(Request $request)
    {
        $filmId = $request->query->get('id');
        $isUserSubscribed = false;

        $contextUser = $this->get('security.token_storage')->getToken()->getUser();
        if ($contextUser instanceof User) {
            $userId = $contextUser->getId();
            
            $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($userId);
            $film = $this->getDoctrine()->getManager()->getRepository(Film::class)->find($filmId);
            $isUserSubscribed = $user->getFilms()->contains($film);
        }
        
        return $this->render('main/film.html.twig', [ 
            'film' => $this->getDoctrine()->getRepository(Film::class)->find($filmId),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'isUserSubscribed' => $isUserSubscribed
        ]);
    }

    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function subscribeAction(Request $request)
    {
        $isUserSubscribed = false;

        $filmId = $request->query->get('id');
        $token = $this->get('security.token_storage')->getToken();
        if ($token === null) {
            $actionMessage = 'Сначала зарегестрируйся!';
        } else {
            try {
                $userId = $token->getUser()->getId();

                $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($userId);
                $film = $this->getDoctrine()->getManager()->getRepository(Film::class)->find($filmId);
                $user->addFilm($film);
                $film->addUser($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->persist($film);
                $em->flush();

                $isUserSubscribed = true;
                $actionMessage = 'Успешно!';
            } catch(Exception $ex) {
                $actionMessage = 'Не вышло((((';
            }
        }

        return $this->redirect('/film?id=' . $filmId);
    }

    /**
     * @Route("/unsubscribe", name="unsubscribe")
     */
    public function unsubscribeAction(Request $request)
    {
        $isUserSubscribed = true;
        $actionMessage;

        $filmId = $request->query->get('id');
        $token = $this->get('security.token_storage')->getToken();
        if ($token === null) {
            $actionMessage = 'Сначала зарегестрируйся!';
        } else {
            try {
                $userId = $this->get('security.token_storage')
                    ->getToken()
                    ->getUser()
                    ->getId();

                $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($userId);
                $film = $this->getDoctrine()->getManager()->getRepository(Film::class)->find($filmId);
                $user->removeFilm($film);
                $film->removeUser($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->persist($film);
                $em->flush();

                $isUserSubscribed = false;
                $actionMessage = 'Успешно!';
            } catch(Exception $ex) {
                $actionMessage = 'Не вышло((((';
            }
        }

        return $this->redirect('/film?id=' . $filmId);
    }
}