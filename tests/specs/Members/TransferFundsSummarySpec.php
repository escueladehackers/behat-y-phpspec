<?php
namespace specs\Ewallet\Members;

use Ewallet\Members\Member;
use PhpSpec\ObjectBehavior;

class TransferFundsSummarySpec extends ObjectBehavior
{
    function it_is_initializable(Member $sender, Member $recipient)
    {
        $this->beConstructedWith($sender, $recipient);
    }
}
