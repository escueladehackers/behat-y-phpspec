<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Members;

use Ewallet\ContractTests\MembersTest;

class InMemoryMembersTest extends MembersTest
{
    public function members(): Members
    {
        return new InMemoryMembers();
    }
}
