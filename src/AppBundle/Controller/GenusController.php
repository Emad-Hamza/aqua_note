<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 06-Dec-18
 * Time: 5:20 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
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

        $funFact = 'Octopuses can change the color of their body in just *three-tenths* of a second!';

        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($funFact);

        if ($cache->contains($key))
        {
            $cache->fetch($key);
        }
        else
        {
            sleep(1);
            $funFact = $this->get('markdown.parser')->transform($funFact);
            $cache->save($key, $funFact);
        }

        return $this->render('genus/show.html.twig', [
            'name' => $genusName,
            'funFact' => $funFact,
//            'notes' => $notes

        ]);

    }

    /**
     * @Route("/genus/{genusName}/notes", name="genus_show_notes",  methods={"GET"})
     */
    public function getNotesAction()
    {

        $notes = [

            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => "Octopus aked me a riddle, outsmarted me", 'date' => 'Dec. 10, 2015'],
            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => "I counted 8 legs... as they wrapped around me", 'date' => 'Dec. 1, 2015'],
            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => "Inked!", 'date' => 'Aug. 20, 2015']
        ];

        $data = [
            'notes' => $notes,
        ];

        return new JsonResponse($data);

    }
}