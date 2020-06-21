<?php

namespace SteveCohenFR\EzSeoBundle\SEO\Providers;

use eZ\Publish\API\Repository\Values\Content\Content;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class AbstractProvider
 * @package SteveCohenFR\EzSeoBundle\SEO\Providers
 */
abstract class AbstractProvider
{
    /** @var  Content */
    private $content;

    /** @var Container */
    private $container;

    /** @var string */
    protected $prefix;

    /** @var string */
    protected $suffix;

    function __construct( Content $content, Container $container )
    {
        $this->content = $content;
        $this->container = $container;
    }

    /**
     * @return array
     */
    public function getMetaSEO()
    {
        return array(
            "meta_title" => $this->getMetaTitle(),
            "meta_description" => $this->getMetaDescription()
        );
    }

    /**
     * @param string $prefix
     *
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @param string $suffix
     *
     * @return $this
     */
    public function setSuffix(string $suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @return Content the current content
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @return Container
     */
    public function getContainer() {
        return $this->container;
    }

    /**
     * @return \eZ\Publish\Core\SignalSlot\Repository|null
     * @throws \Exception
     */
    public function getRepository() {
        return $this->container->get("ezpublish.api.repository");
    }

    abstract function getMetaTitle();
    abstract function getMetaDescription();
}