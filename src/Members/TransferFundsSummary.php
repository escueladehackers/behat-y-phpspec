<?php
namespace Ewallet\Members;

class TransferFundsSummary
{
    /**
     * @var Member
     */
    private $sender;

    /**
     * @var Member
     */
    private $recipient;

    public function __construct(Member $sender, Member $recipient)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    public function sender()
    {
        return $this->sender;
    }

    public function recipient()
    {
        return $this->recipient;
    }
}
