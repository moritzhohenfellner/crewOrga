<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Toern;

class CrewController extends AbstractController
{
  /**
  * @Route("toern/{toernId}/crew", name="crew_list")
  */
  public function index($toernId)
  {
    $entityManager = $this->getDoctrine()->getManager();
    $toern = $entityManager->find(Toern::class, $toernId);
    $flashbag = $this->get('session')->getFlashBag();
    if(!$toern->checkPermission('view-crew-list', $this->getUser())){
      $flashbag->add("danger", "Keine Berechtigung diesen Törn zu bearbeiten!");
      return $this->redirectToRoute('toern_list');
    }


    return $this->render('crew/crewList.html.twig', [
      'toern' => $toern,
    ]);
  }
}
