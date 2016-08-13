<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Doctrine;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\{EntityManager, EntityManagerInterface};
use Doctrine\ORM\Tools\{SchemaTool, Setup};

trait EntityManagerSetup
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @return EntityManagerInterface
     */
    public function _entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * Setup XML mapping configuration
     * Configure entity manager
     *
     * @param array $options
     */
    public function _setUpDoctrine(array $options)
    {
        if ($this->entityManager) { // Do not initialize twice
            return;
        }

        $configuration = Setup::createXMLMetadataConfiguration(
            $options['doctrine']['mapping_dirs'],
            $options['doctrine']['dev_mode'],
            $options['doctrine']['proxy_dir']
        );
        $this->entityManager = EntityManager::create(
            $options['doctrine']['connection'], $configuration
        );
    }

    public function _updateDatabaseSchema(array $options)
    {
        $this->_setUpDoctrine($options);
        $tool = new SchemaTool($em = $this->_entityManager());
        $tool->updateSchema($em->getMetadataFactory()->getAllMetadata(), true);
    }

    public function _emptyTable($entityClass)
    {
        $this
            ->_entityManager()
            ->createQuery("DELETE FROM $entityClass")
            ->execute()
        ;
    }
}
