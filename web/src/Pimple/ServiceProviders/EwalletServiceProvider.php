<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Pimple\ServiceProviders;

use Doctrine\ORM\{EntityManager, Tools\Setup};
use Ewallet\ManageWallet\TransferFunds;
use Ewallet\Members\Member;
use Ewallet\Slim\Controllers\TransferFundsController;
use Pimple\{Container, ServiceProviderInterface};
use Twig_Loader_Filesystem as Loader;
use Twig_Environment as Environment;

class EwalletServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        // doctrine/orm
        $container['doctrine.em'] = function () use ($container) {
            $configuration = Setup::createXMLMetadataConfiguration(
                $container['doctrine']['mapping_dirs'],
                $container['doctrine']['dev_mode'],
                $container['doctrine']['proxy_dir']
            );
            $entityManager = EntityManager::create(
                $container['doctrine']['connection'], $configuration
            );
            return $entityManager;
        };

        // twig/twig
        $container['twig.loader'] = function () use ($container) {
            return new Loader($container['twig']['loader_paths']);
        };
        $container['twig.environment'] = function () use ($container) {
            return new Environment(
                $container['twig.loader'],
                $container['twig']['options']
            );
        };

        // ewallet/doctrine
        $container['ewallet.member_repository'] = function () use ($container) {
            return $container['doctrine.em']->getRepository(Member::class);
        };

        // ewallet/domain
        $container['ewallet.transfer_funds'] =  function () use ($container) {
            return new TransferFunds(
                $container['ewallet.member_repository']
            );
        };

        // ewallet/web
        $container['ewallet.transfer_form_controller'] = function () use ($container) {
            return new TransferFundsController($container['twig.environment']);
        };
        $container['ewallet.transfer_funds_controller'] = function () use ($container) {
            return new TransferFundsController(
                $container['twig.environment'],
                $container['ewallet.transfer_funds']
            );
        };
    }
}
