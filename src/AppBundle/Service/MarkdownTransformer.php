<?php
/**
 * Created by PhpStorm.
 * User: Mahmoud S. Siddiq
 * Date: 03-Jan-19
 * Time: 6:18 PM
 */

namespace AppBundle\Service;


use Doctrine\Common\Cache\Cache;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownTransformer
{
    private $markdownParser;

    private $cache;


    public function __construct(MarkdownParserInterface $markdownParser, Cache $cache)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse($str)
    {

                $cache = $this->cache;
        $key = md5($str);

        if ($cache->contains($key))
        {
            return $cache->fetch($key);
        }

        sleep(1);

        $str = $this->markdownParser->transformMarkdown($str);

        $cache->save($key, $str);

        return $str;
    }

}