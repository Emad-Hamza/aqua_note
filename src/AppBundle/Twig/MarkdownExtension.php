<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 07-Jan-19
 * Time: 6:40 PM
 */

namespace AppBundle\Twig;




use AppBundle\Service\MarkdownTransformer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;


class MarkdownExtension extends AbstractExtension
{

    private $markdownTransformer;


    public function __construct(MarkdownTransformer $markdownTransformer)
    {
        $this->markdownTransformer = $markdownTransformer;
    }

    public function getFilters()
    {
        return [

            new TwigFilter('markdownify', array($this, 'parseMarkdown'),
                [
                    'is_safe' => ['html']
                ])
        ];

    }

    public function parseMarkdown ($str)
    {
        return strtoupper($str);
    }


    public function getName()
    {
        return 'app_markdown'; // TODO: Change the autogenerated stub
    }


}