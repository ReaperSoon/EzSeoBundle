<?php

namespace SteveCohen\Gs1Bundle\SEO\Exception;

/**
 * Created by PhpStorm.
 * User: stcoh
 * Date: 23/03/18
 * Time: 18:08
 */
class SEOException extends \RuntimeException
{
    private $content;

    public function __construct($message, $content, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->content = $content;
    }
    public function getContent()
    {
        return $this->content;
    }
}