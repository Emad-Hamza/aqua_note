<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 03-Jan-19
 * Time: 6:18 PM
 */

namespace AppBundle\Service;


use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;

    public function __construct(MarkdownParserInterface $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse($str)
    {
        return $this->markdownParser->transformMarkdown($str);
    }

}