<?php
namespace specs\Ewallet\Members;

use Ewallet\Members\Member;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MemberSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        // when
        $this->beConstructedThrough('withAccountBalance', [5000]);

        // then
        $this->accountBalance()->shouldBe(5000);
    }

    function it_transfer_funds_to_a_recipient()
    {
        // Given
        $this->beConstructedThrough('withAccountBalance', [5000]);
        $myFriend = Member::withAccountBalance(4000);

        // When
        $this->transfer($myFriend, 2000);

        // Then
        $this->accountBalance()->shouldBe(3000);
    }

    function it_can_receive_funds_from_a_sender()
    {
        // Given
        $this->beConstructedThrough('withAccountBalance', [4000]);
        $myFriend = Member::withAccountBalance(5000);

        // When
        $myFriend->transfer($this->getWrappedObject(), 2000);

        // Then
        $this->accountBalance()->shouldBe(6000);
    }
}
