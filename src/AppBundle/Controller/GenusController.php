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

//        $notes = [
//            'Octopus aked me a riddle, outsmarted me',
//            'I counted 8 legs... as they wrapped around me',
//            'Inked!'
//        ];

        return $this->render('genus/show.html.twig', [
            'name' => $genusName,
//            'notes' => $notes

        ]);

    }

    /**
     * @Route("/genus/{genusName}/notes", name="genus_show_notes",  methods={"GET"})
     */
    public function getNotesAction()
    {

        $notes = [

            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' =>"Octopus aked me a riddle, outsmarted me", 'date' => 'Dec. 10, 2015' ],
                ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' =>"I counted 8 legs... as they wrapped around me", 'date' => 'Dec. 1, 2015'],
                    ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' =>"Inked!", 'date' => 'Aug. 20, 2015']
        ];

        $data = [
            'notes' =>$notes,
        ];

        return new JsonResponse($data);

    }
}