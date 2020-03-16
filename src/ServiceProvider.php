<?php


namespace Seek\QuansutongSDK;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container['api'] = function ($container) {
            $config = $container->getConfig();
            return new Api($config['appKey'], $config['appSecret']);
        };

        $container['order'] = function ($container) {
            $config = $container->getConfig();
            return new Order($config['appKey'], $config['appSecret']);
        };
    }
}