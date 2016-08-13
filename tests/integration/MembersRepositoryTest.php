<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Members;

use Ewallet\ContractTests\MembersTest;
use Ewallet\Doctrine\EntityManagerSetup;

class MembersRepositoryTest extends MembersTest
{
    use EntityManagerSetup;

    function setUp()
    {
        $this->_setUpDoctrine(require __DIR__ . '/../../config.php');
        $this->_emptyTable(Member::class);
        parent::setUp();
    }

    public function members(): Members
    {
        return $this->_entityManager()->getRepository(Member::class);
    }
}
