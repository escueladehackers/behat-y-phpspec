<?php
namespace specs\Ewallet\Members;

use Ewallet\Members\Member;
use Money\Money;
use PhpSpec\ObjectBehavior;

class MemberSpec extends ObjectBehavior
{
    function it_has_an_initial_account_balance()
    {
        // when
        $this->beConstructedThrough('withAccountBalance', [1, Money::MXN(5000)]);

        // then
        $this->id()->shouldBe(1);
        $this->accountBalance()->equals(Money::MXN(5000))->shouldBe(true);
    }

    function it_transfer_funds_to_a_recipient()
    {
        // Given
        $this->beConstructedThrough('withAccountBalance', [1, Money::MXN(5000)]);
        $myFriend = Member::withAccountBalance(2, Money::MXN(4000));

        // When
        $this->transfer($myFriend, Money::MXN(2000));

        // Then
        $this->accountBalance()->equals(Money::MXN(3000))->shouldBe(true);
    }

    function it_receives_funds_from_a_sender()
    {
        // Given
        $this->beConstructedThrough('withAccountBalance', [1, Money::MXN(4000)]);
        $myFriend = Member::withAccountBalance(2, Money::MXN(5000));

        // When
        $myFriend->transfer($this->getWrappedObject(), Money::MXN(2000));

        // Then
        $this->accountBalance()->equals(Money::MXN(6000))->shouldBe(true);
    }

    function it_knows_when_it_is_equal_to_another_member()
    {
        // Given
        $this->beConstructedThrough('withAccountBalance', [1, Money::MXN(4000)]);
        $myself = Member::withAccountBalance(1, Money::MXN(4000));

        // When - Then
        $this->equals($myself)->shouldBe(true);
    }

    function it_knows_when_it_is_not_equal_to_another_member()
    {
        // Given
        $this->beConstructedThrough('withAccountBalance', [1, Money::MXN(4000)]);
        $anotherMember = Member::withAccountBalance(2, Money::MXN(3000));

        // When - Then
        $this->equals($anotherMember)->shouldBe(false);
    }
}
