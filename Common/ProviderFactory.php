<?php
/**
 * Created by PhpStorm.
 * User: stcoh
 * Date: 26/03/18
 * Time: 15:30
 */

namespace SteveCohenFR\EzSeoBundle\Common;

use eZ\Publish\API\Repository\Values\Content\Content;
use SteveCohenFR\EzSeoBundle\SEO\Providers\AbstractProvider;
use Symfony\Component\DependencyInjection\Container;

class ProviderFactory
{
    private $identifier;
    private $className;

    function __construct( $identifier, $className )
    {
        $this->identifier = $identifier;
        $this->className = $className;
    }

    /**
     * @param Content|null   $content
     * @param Container $container
     *
     * @return mixed
     */
    public function get( ?Content $content, Container $container )
    {
        return new $this->className($content, $container);
    }

    /**
     * @return string identifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string class_name
     */
    public function getClassName()
    {
        return $this->className;
    }
}