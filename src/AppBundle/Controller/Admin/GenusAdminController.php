<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_MANAGE_GENUS')")
 */
class GenusAdminController extends Controller
{
    /**
     * @Route("/genus", name="admin_genus_list")
     */
    public function indexAction()
    {

//        $this->denyAccessUnlessGranted('ROLE_ADMIN', '', 'Denied is the access.');

        $genuses = $this->getDoctrine()
            ->getRepository('AppBundle:Genus')
            ->findAll();

        return $this->render('admin/genus/list.html.twig', array(
            'genuses' => $genuses
        ));
    }

    /**
     * @Route("/genus/new", name="admin_genus_new")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm('AppBundle\Form\GenusFormType');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $genus = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($genus);
            $em->flush();

            $this->addFlash('success',
                sprintf('Genus created by (%s)!', $this->getUser()->getEmail()));

            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render('admin/genus/new.html.twig',
            [
               'genusForm' => $form->createView()
            ]);
    }

    /**
     * @Route("/genus/{id}/edit", name="admin_genus_edit")
     */
    public function editAction(Request $request, Genus $genus)
    {
        $form = $this->createForm('AppBundle\Form\GenusFormType', $genus);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $genus = $form->getData();

            $em = $this->getDoctrine();
            $em = $this->getDoctrine()->getManager();
            $em->persist($genus);
            $em->flush();

            $this->addFlash('success',
                sprintf('Genus updated by (%s)!', $this->getUser()->getEmail()));

            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render('admin/genus/edit.html.twig',
            [
                'genusForm' => $form->createView()
            ]);
    }


}