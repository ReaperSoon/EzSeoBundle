<?php

namespace SteveCohenFR\EzSeoBundle\Services;

use eZ\Publish\Core\Repository\ContentTypeService;
use eZ\Publish\Core\SignalSlot\Repository;
use eZ\Publish\API\Repository\Values\Content\Content;
use SteveCohenFR\EzSeoBundle\Common\ProviderAggregator;
use SteveCohenFR\EzSeoBundle\SEO\Providers\AbstractProvider;
use Symfony\Component\DependencyInjection\Container;

class SteveCohenFRSeoProvider
    {
        /**
         * @var ContentTypeService
         */
        private $contentTypeService;

        /**
         * @var ProviderAggregator
         */
        private $providerAggregator;

        private $container;

        public function __construct( Container $container, ProviderAggregator $providerAggregator ) {
            $repository = $container->get("ezpublish.signalslot.repository");
            $this->contentTypeService = $repository->getContentTypeService();
            $this->providerAggregator = $providerAggregator;
            $this->container = $container;
        }

        /**
         * @param Content $content
         * @return AbstractProvider
         */
        public function getSEO( Content $content, $prefix = "", $suffix = "" )
        {
            $provider = null;
            $contentType = $this->contentTypeService->loadContentType(
                $content->contentInfo->contentTypeId
            );

            if ($this->providerAggregator->hasProvider($contentType->identifier))
            {
                /** @var AbstractProvider $provider */
                $provider = $this->providerAggregator->getProvider($contentType->identifier)->get( $content, $this->container );
                $provider->setPrefix($prefix)->setSuffix($suffix);
            }

            return $provider;
        }

        public function getRouteSEO( string $route, $prefix = "", $suffix = "" )
        {
            $provider = null;

            if ($this->providerAggregator->hasProvider($route))
            {
                /** @var AbstractProvider $provider */
                $provider = $this->providerAggregator->getProvider($route)->get( null, $this->container );
                $provider->setPrefix($prefix)->setSuffix($suffix);
            }

            return $provider;
        }

        public function getMetaSeo( Content $content )
        {
            $seoProvider = $this->getSEO($content);
            if ($seoProvider == null) return null;
            return $seoProvider->getMetaSEO();
        }
    }