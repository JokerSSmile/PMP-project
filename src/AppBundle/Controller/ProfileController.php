<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Entity\Film;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function showAction(Request $request)
    {
        $contextUser = $this->get('security.token_storage')->getToken()->getUser();
        if (!$contextUser instanceof User) {
            return $this->redirect('/login');
        }

        $requestedUserId = $request->query->get('id');
        $userId;
        if ($requestedUserId == null) {
            $userId = $contextUser->getId();
        } else {
            $userId = $requestedUserId;
        }

        return $this->render('main/profile.html.twig', [ 
            'user' => $this->getDoctrine()->getRepository(User::class)->find($userId),
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}