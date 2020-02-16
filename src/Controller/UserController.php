<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Controller\SecurityController;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
          $data = $form->getData();

          $user = new User();

          $user->setUsername($data->getUsername());
          $user->setRoles(['ROLE_ADMIN']);
          $user->setPassword(
            $passwordEncoder->encodePassword($user, $data->getPassword()),
          );

          dump($user);
          $em = $this->getDoctrine()->getManager();

          $em->persist($user);
          $em->flush();

          return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
