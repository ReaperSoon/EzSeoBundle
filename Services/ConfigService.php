<?php

namespace SteveCohenFR\EzSeoBundle\Services;

use eZ\Publish\Core\Repository\ContentTypeService;
use eZ\Publish\Core\SignalSlot\Repository;
use eZ\Publish\API\Repository\Values\Content\Content;
use SteveCohenFR\EzSeoBundle\Common\ProviderAggregator;
use SteveCohenFR\EzSeoBundle\SEO\Providers\AbstractProvider;

    class ConfigService
    {
        /** @var array */
        private $config;

        public function __construct( array $config ) {
            $this->config = $config;
        }

        /**
         * Get the configuration array from steve_cohen_fr_ez_seo.config
         *
         * @return array
         */
        public function getConfig() {
            return $this->config;
        }

        /**
         * Get the configuration array from steve_cohen_fr_ez_seo.config.meta_title
         *
         * @return array
         */
        public function getMetaTitleConfig() {
            return $this->config["meta_title"];
        }

        /**
         * Get the configuration array from steve_cohen_fr_ez_seo.config.meta_description
         *
         * @return array
         */
        public function getMetaDescriptionConfig() {
            return $this->config["meta_description"];
        }

    }