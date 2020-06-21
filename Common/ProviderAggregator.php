<?php

namespace SteveCohenFR\EzSeoBundle\Common;

use SteveCohenFR\EzSeoBundle\Common\ProviderFactory as Provider;

class ProviderAggregator
{
    /**
     * @var Provider[]
     */
    private $providers = [];

    public function __construct()
    {
    }

    /**
     * Registers a new provider to the aggregator.
     *
     * @param Provider $provider
     *
     * @return ProviderAggregator
     */
    public function registerProvider(Provider $provider)
    {
        $this->providers[$provider->getIdentifier()] = $provider;

        return $this;
    }

    /**
     * Registers a set of providers.
     *
     * @param Provider[] $providers
     *
     * @return ProviderAggregator
     */
    public function registerProviders(array $providers = [])
    {
        foreach ($providers as $provider) {
            $this->registerProvider($provider);
        }

        return $this;
    }

    /**
     * Returns all registered providers indexed by their name.
     *
     * @return Provider[]
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * Get a provider to use for this query.
     *
     * @param string                  $providerName
     *
     * @return Provider
     */
    public function getProvider($providerName)
    {
        if (!array_key_exists($providerName, $this->providers)) {
            return null;
        }
        return $this->providers[$providerName];
    }

    /**
     * Check if a provider exists
     *
     * @param $providerName
     * @return bool
     */
    public function hasProvider($providerName)
    {
        return array_key_exists($providerName, $this->providers);
    }
}
