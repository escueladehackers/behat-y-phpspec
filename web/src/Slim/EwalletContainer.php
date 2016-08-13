<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Slim;

use Ewallet\Pimple\ServiceProviders\EwalletServiceProvider;
use Slim\Container;

class EwalletContainer extends Container
{
    public function __construct(array $arguments = [])
    {
        parent::__construct($arguments);
        $this->register(new EwalletServiceProvider());
    }
}
