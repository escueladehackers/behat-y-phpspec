<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Alice;

use Doctrine\Common\Persistence\ObjectManager;
use Ewallet\Members\Member;
use Nelmio\Alice\Fixtures;

class TwoMembersWithDifferentBalances
{
    /** @var ObjectManager */
    private $objectManager;

    /**
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Cleanup before populating `members` table
     */
    public function load()
    {
        $this
            ->objectManager
            ->createQuery('DELETE FROM ' . Member::class)
            ->execute()
        ;
        Fixtures::load(
            __DIR__ . '/../../fixtures/members.yml',
            $this->objectManager
        );
    }
}
