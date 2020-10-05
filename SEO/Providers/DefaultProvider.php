<?php


namespace SteveCohenFR\EzSeoBundle\SEO\Providers;


use eZ\Publish\API\Repository\Values\Content\Content;
use Symfony\Component\DependencyInjection\Container;

class DefaultProvider extends AbstractProvider
{
    /** @var array */
    private $config;

    public function __construct(?Content $content, ?Container $container, $config)
    {
        parent::__construct($content, $container);
        $this->config = $config;
    }

    function getMetaTitle()
    {
        return $this->config["meta_title"]["default"];
    }

    function getMetaDescription()
    {
        return $this->config["meta_description"]["default"];
    }
}