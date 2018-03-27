<?php
/**
 * Created by PhpStorm.
 * User: stcoh
 * Date: 26/03/18
 * Time: 14:46
 */

namespace SteveCohen\EzSeoBundle\DependencyInjection;


use SteveCohen\EzSeoBundle\Common\ProviderAggregator;
use SteveCohen\EzSeoBundle\Common\ProviderFactory;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class AddProvidersPass implements CompilerPassInterface
{
    /**
     * Get all providers based on their tag (`bazinga_geocoder.provider`) and
     * register them.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition("stevecohen.ez_seo.provider_aggregator")) {
            return;
        }
        $providerAggregator = $container->getDefinition("stevecohen.ez_seo.provider_aggregator");
        $providers = [];

        $configs = $container->getExtensionConfig('stevecohen_ez_seo');
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($config['providers'] as $providerId => $attributes) {
            $provider = new Definition('SteveCohen\EzSeoBundle\Common\ProviderFactory', array($providerId, $attributes['class']));
            $providers[] = $provider;
        }
        $providerAggregator->addMethodCall('registerProviders', [$providers]);
    }

    private function processConfiguration(ConfigurationInterface $configuration, array $configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration($configuration, $configs);
    }
}