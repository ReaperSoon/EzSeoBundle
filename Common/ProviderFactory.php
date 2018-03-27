<?php
/**
 * Created by PhpStorm.
 * User: stcoh
 * Date: 26/03/18
 * Time: 15:30
 */

namespace SteveCohen\EzSeoBundle\Common;

use eZ\Publish\API\Repository\Values\Content\Content;
use SteveCohen\EzSeoBundle\SEO\Providers\AbstractProvider;

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
     * @param Content $content
     * @return AbstractProvider
     */
    public function get( Content $content )
    {
        return new $this->className($content);
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