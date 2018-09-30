<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Toern;
use App\Form\ToernType;

class ToernController extends AbstractController
{
  /**
  * @Route("/toern/create", name="toern_create")
  */
  public function create(Request $request)
  {

    $toern = new Toern();
    $toern->setOwningUser($this->getUser());
    $form = $this->createForm(ToernType::class, $toern);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $toern = $form->getData();

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($toern);
      $entityManager->flush();
      return $this->redirectToRoute('index');
    }

    return $this->render('toern/createToern.html.twig', [
      'controller_name' => 'ToernController',
      'form' => $form->createView(),
    ]);
  }
}
