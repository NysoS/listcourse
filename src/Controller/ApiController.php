<?php

namespace App\Controller;

use App\Entity\Liste;
use App\Repository\ListeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api_liste", methods={"GET"})
     */
    public function lister(ListeRepository $rep): Response
    {
        
        $objet = $rep->findAll();
        return $this->json($objet);

    }

    /**
     * @Route("/api", name="api_ajouter", methods={"POST"})
     */
    public function ajouter(Request $req, EntityManagerInterface $em): Response
    {
        
        $obj = json_decode($req->getContent());

        $liste = new Liste();
        $liste->setName($obj->name);
        $liste->setBuy(false);

        $em->persist($liste);
        $em->flush();

        return $this->json($liste);

    }

    /**
     * @Route("/api/{id}", name="api_update", methods={"PUT"})
     */
    public function update(Liste $obj, EntityManagerInterface $em, Request $req): Response
    {
        $upt = json_decode($req->getContent());

        $etat = !$obj->getBuy();

        $obj->setName($upt->name);
        $obj->setBuy($etat);

        $em->flush();

        return $this->json($obj);

    }

    /**
     * @Route("/api/{id}", name="api_delete", methods={"DELETE"})
     */
    public function delete(Liste $obj, EntityManagerInterface $em, Request $req): Response
    {
        
        $em->remove($obj);
        $em->flush();

        return $this->json("{'ok':'ok'}");

    }
}
