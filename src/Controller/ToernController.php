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
      $flashbag = $this->get('session')->getFlashBag();
      $flashbag->add("success", "Törn wurde erstellt");
      return $this->redirectToRoute('toern_list');
    }

    return $this->render('toern/createToern.html.twig', [
      'controller_name' => 'ToernController',
      'form' => $form->createView(),
    ]);
  }

  /**
  * @Route("/toern/{toernId}/edit/", name="toern_edit")
  */
  public function edit(Request $request, $toernId){
    $entityManager = $this->getDoctrine()->getManager();
    $toern = $entityManager->find(Toern::class, $toernId);
    // Retrieve flashbag from the controller
    $flashbag = $this->get('session')->getFlashBag();
    //check permission
    if(!$toern->checkPermission('edit-core-data', $this->getUser())){
      $flashbag->add("danger", "Keine Berechtigung diesen Törn zu bearbeiten!");
      return $this->redirectToRoute('toern_list');
    }

    $form = $this->createForm(ToernType::class, $toern);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

      $toern = $form->getData();

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($toern);
      $entityManager->flush();
      $flashbag = $this->get('session')->getFlashBag();
      $flashbag->add("success", "Änderungen wurden gespeichert");
      return $this->redirectToRoute('toern_list');
    }

    return $this->render('toern/createToern.html.twig', [
      'controller_name' => 'ToernController',
      'form' => $form->createView(),
    ]);
  }

  /**
  * @Route("/toern/", name="toern_list")
  */
  public function list(){
    $toerns = $this->getUser()->getToerns();
    return $this->render('toern/listToerns.html.twig', ['toerns' => $toerns]);
  }

  /**
  * @Route("/toern/{toernId}/delete/", name="toern_delete")
  */
  public function delete($toernId){
    $entityManager = $this->getDoctrine()->getManager();
    $toern = $entityManager->find(Toern::class, $toernId);
    // Retrieve flashbag from the controller
    $flashbag = $this->get('session')->getFlashBag();

    //check permission
    if(!$toern->checkPermission('delete', $this->getUser())){
      $flashbag->add("danger", "Keine Berechtigung diesen Törn zu löschen!");
      return $this->redirectToRoute('toern_list');
    }else{
      $entityManager->remove($toern);
      $entityManager->flush();
      $flashbag->add("success", "Törn gelöscht");
    }



    return $this->redirectToRoute('toern_list');
  }
}
