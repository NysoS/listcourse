<?php

namespace App\Controller;

use App\Entity\Liste;
use App\Form\ListType;
use App\Repository\ListeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function main(ListeRepository $repo): Response
    {

        $res = $repo->findBy([],array('name' => 'DESC'));

        return $this->render('main/listeCourse.html.twig',
                            ["lstCourse" => $res]);
    }

    /**
     * @Route("/add", name="addElt")
     */
    public function add(Request $req, EntityManagerInterface $em): Response
    {

        $elt = $req->get('elt');

        $lstC = new Liste();
        $lstC->setName($elt);
        $lstC->setBuy(false);

        $em->persist($lstC);
        $em->flush();

        return $this->redirectToRoute("main");
        
    }

    /**
     * @Route("/update/{id}", name="modifElt")
     */
    public function update(Liste $lst, EntityManagerInterface $em): Response
    {
        
        $lst->setBuy(true);
        $em->flush();

        return $this->redirectToRoute("main");
        
    }

    /**
     * @Route("/delete/{id}", name="delElt")
     */
    public function delete(Liste $lst, EntityManagerInterface $em): Response
    {

        $em->remove($lst);
        $em->flush();

        return $this->redirectToRoute("main");
        
    }
}
