<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Department;
use App\Form\DepartmentType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/department", name="department.")
 */
class DepartmentController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function index()
    {
      $departments = $this->getDoctrine()->getRepository(Department::class)->findAll();

      return $this->render('department/index.html.twig', [
          'departments' => $departments
      ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(Request $request)
    {
      $department = new Department();
      $form = $this->createForm(DepartmentType::class, $department);

      $form->handleRequest($request);

      if ($form->isSubmitted()) {
        $em = $this->getDoctrine()->getManager();

        $em->persist($department);
        $em->flush();

        $this->addFlash('success', 'Complete task');

        return $this->redirect($this->generateUrl('department.list'));
      }

      return $this->render('department/add.html.twig', [
          'form' => $form->createView()
      ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id)
    {
        $user = $this->getDoctrine()->getRepository(Department::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        try {
          $em->remove($user);
          $em->flush();
          $this->addFlash('success', 'Complete task');
        } catch (\Exception $e) {
          $this->addFlash('notice', 'Incomplete task (SQL)');
        }

        return $this->redirect($this->generateUrl('department.list'));
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit($id, Request $request)
    {
      $department = $this->getDoctrine()->getRepository(Department::class)->find($id);
      $form = $this->createForm(DepartmentType::class, $department);

      $form->handleRequest($request);

      if ($form->isSubmitted()) {
        $em = $this->getDoctrine()->getManager();

        $em->persist($department);
        $em->flush();

        $this->addFlash('success', 'Complete task');

        return $this->redirect($this->generateUrl('department.list'));
      }

      return $this->render('department/edit.html.twig', [
          'form' => $form->createView()
      ]);
    }

}
