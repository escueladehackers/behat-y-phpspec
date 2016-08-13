<?php

namespace specs\Ewallet\ManageWallet;

use Ewallet\ManageWallet\TransferFunds;
use Ewallet\Members\Member;
use Ewallet\Members\Members;
use Money\Money;
use PhpSpec\ObjectBehavior;

class TransferFundsSpec extends ObjectBehavior
{
    function it_is_initializable(Members $members)
    {
        $this->beConstructedWith($members);
        $this->shouldHaveType(TransferFunds::class);
    }

    function it_transfer_funds_between_members(Members $members)
    {
        $senderId = 1;
        $recipientId = 2;
        $amount = Money::MXN(20000);
        $sender = Member::withAccountBalance($senderId, Money::MXN(50000));
        $recipient = Member::withAccountBalance($recipientId, Money::MXN(40000));
        $members->with($senderId)->willReturn($sender);
        $members->with($recipientId)->willReturn($recipient);
        $members->update($sender)->shouldBeCalled();
        $members->update($recipient)->shouldBeCalled();
        $this->beConstructedWith($members);

        $summary = $this->transfer($senderId, $recipientId, $amount);

        $summary->sender()->equals($sender)->shouldBe(true);
        $summary->recipient()->equals($recipient)->shouldBe(true);
    }
}
