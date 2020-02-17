<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Controller\SecurityController;
use App\Services\FileUploader;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();


        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile()
    {
        return $this->render('user/profile.html.twig', [
            // 'users' => $users,
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, FileUploader $fileUploader)
    {
        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
          $data = $form->getData();

          $user = new User();

          $user->setUsername($data['username']);
          $user->setName($data['name']);
          $user->setLname($data['lname']);
          $user->setEmail($data['email']);
          $user->setDepartment($data['department']);

          $user->setRoles([$data['role']]);

          $user->setPassword(
            $passwordEncoder->encodePassword($user, $data['password']),
          );

          $em = $this->getDoctrine()->getManager();

          $file = $request->files->get('user')['attachment'];

          /** @var UploadedFile $file */
          if($file) {
            $filename =  $fileUploader->uploadFile($file);

            $user->setImage($filename);
          } else {
            $filename =  "default.png";

            $user->setImage($filename);
          }

          $em->persist($user);
          $em->flush();

          $this->addFlash('success', 'Complete task');

          return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Complete task');

        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit($id, Request $request, UserPasswordEncoderInterface $passwordEncoder, FileUploader $fileUploader)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class);

        $form->get('name')->setData($user->getName());
        $form->get('lname')->setData($user->getLname());
        $form->get('username')->setData($user->getUsername());
        $form->get('password')->setData("");
        $form->get('email')->setData($user->getEmail());
        $image = $user->getImage();

        $form->get('role')->setData($user->getRoles()[0]);

        $form->get('department')->setData($user->getDepartment());

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
          $data = $form->getData();

          $user->setUsername($data['username']);
          $user->setName($data['name']);
          $user->setLname($data['lname']);
          $user->setEmail($data['email']);
          $user->setDepartment($data['department']);

          $user->setRoles([$data['role']]);

          $user->setPassword(
            $passwordEncoder->encodePassword($user, $data['password']),
          );

          $em = $this->getDoctrine()->getManager();

          $file = $request->files->get('user')['attachment'];

          /** @var UploadedFile $file */
          if($file) {
            $filename =  $fileUploader->uploadFile($file);

            $user->setImage($filename);
          } else {
            $filename =  $image;

            $user->setImage($filename);
          }

          $em->persist($user);
          $em->flush();

          $this->addFlash('success', 'Complete task');

          return $this->redirect($this->generateUrl('index'));
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
