<?php

namespace SteveCohenFR\EzSeoBundle\SEO\Providers;

use SteveCohenFR\EzSeoBundle\SEO\Exception\SEOException;
use eZ\Publish\API\Repository\Values\Content\Content;

/**
 * Created by PhpStorm.
 * User: stcoh
 * Date: 23/03/18
 * Time: 18:03
 */
abstract class AbstractProvider
{
    protected $className;

    /** @var  Content $content  */
    protected $content;

    protected $prefix;

    protected $suffix;

    function __construct( $content )
    {
        $this->className = $this->getClassName();
        $this->content = $content;
    }

    public function getMetaSEO()
    {
        return array(
            "meta_title" => $this->getMetaTitle(),
            "meta_description" => $this->getMetaDescription()
        );
    }

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    abstract function getMetaTitle();
    abstract function getMetaDescription();
    abstract function getClassName();
}