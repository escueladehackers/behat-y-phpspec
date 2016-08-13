<?php
namespace Ewallet\ManageWallet;

use Ewallet\Members\Members;
use Money\Money;

class TransferFunds
{
    /**
     * @var Members
     */
    private $members;

    public function __construct(Members $members)
    {
        $this->members = $members;
    }

    public function transfer(int $senderId, int $recipientId, Money $amount)
    {
        $sender = $this->members->with($senderId);
        $recipient = $this->members->with($recipientId);

        $sender->transfer($recipient, $amount);

        $this->members->update($sender);
        $this->members->update($recipient);
    }
}
