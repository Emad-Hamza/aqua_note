<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 06-Dec-18
 * Time: 5:20 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{
    /**
     * @Route("/genus/{genusName}")
     */
    public function showAction($genusName)
    {

//        $templating = $this->container->get('templating');
        return $this->render('genus/show.html.twig', [
            'name' => $genusName,

        ]);

    }

    /**
     * @Route("/genus/{genusName}/notes", name="genus_show_notes",  methods={"GET"})
     */
    public function getNotesAction()
    {

        $notes = [
            ["name"=>"Edward","phone"=>"056 5733 3475","email"=>"sem.ut.cursus@nonummyipsum.co.uk","company"=>"Eu Ligula Aenean Corp."],
            ["name"=>"Jolene","phone"=>"(016977) 9645","email"=>"ac.libero@etrisus.com","company"=>"Nunc Lectus Limited"],
            ["name"=>"Rhea","phone"=>"056 0388 6065","email"=>"Cras@Donecdignissimmagna.com","company"=>"Pellentesque PC"]

        ];

        $data = [
            'notes' =>$notes,
        ];

        return new JsonResponse($data);

    }
}