<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Slim;

use Ewallet\Slim\Providers\EwalletControllerProvider;
use Slim\App;

class Application extends App
{
    /**
     * Register all the application services, routes and middleware
     *
     * @param  array $arguments Associative array of application settings
     */
    public function __construct(array $arguments = [])
    {
        parent::__construct($container = new EwalletContainer($arguments));
        $container->register(new EwalletControllerProvider($this));
    }
}