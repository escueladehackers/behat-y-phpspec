<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\ContractTests;

use Ewallet\Members\{Member, Members};
use Money\Money;
use PHPUnit_Framework_TestCase as TestCase;

abstract class MembersTest extends TestCase
{
    /** @var Members */
    private $members;

    abstract public function members(): Members;

    function setUp()
    {
        $this->members = $this->members();
    }

    /** @test */
    function it_retrieves_a_known_member()
    {

        $member = Member::withAccountBalance(1, Money::MXN(5000));
        $this->members->add($member);

        $this->assertTrue($this->members->with($member->id())->equals($member));
    }

    /** @test */
    function it_updates_a_member_information()
    {
        $sender = Member::withAccountBalance(1, Money::MXN(5000));
        $this->members->add($sender);

        $recipient = Member::withAccountBalance(2, Money::MXN(5000));
        $this->members->add($recipient);

        $sender->transfer($recipient, Money::MXN(1000));
        $this->members->update($sender);
        $this->members->update($recipient);

        $this->assertEquals(4000, $this->members->with($sender->id())->accountBalance()->getAmount());
        $this->assertEquals(6000, $this->members->with($recipient->id())->accountBalance()->getAmount());
    }
}
