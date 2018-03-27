<?php

namespace Smile\EzSeoBundle\Services;

use eZ\Publish\Core\Repository\ContentTypeService;
use eZ\Publish\Core\SignalSlot\Repository;
use eZ\Publish\API\Repository\Values\Content\Content;
use Smile\EzSeoBundle\Common\ProviderAggregator;
use Smile\EzSeoBundle\SEO\Providers\AbstractProvider;

    class SmileSeoProvider
    {
        /**
         * @var ContentTypeService
         */
        private $contentTypeService;

        /**
         * @var ProviderAggregator
         */
        private $providerAggregator;

        public function __construct( Repository $repository, ProviderAggregator $providerAggregator ) {
            $this->contentTypeService = $repository->getContentTypeService();
            $this->providerAggregator = $providerAggregator;
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
                $provider = $this->providerAggregator->getProvider($contentType->identifier)->get( $content );
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