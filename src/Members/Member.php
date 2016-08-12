<?php
namespace Ewallet\Members;

use Money\Money;

class Member
{
    /** @var Money */
    private $balance;

    /** @var int */
    private $memberId;

    private function __construct(int $memberId, Money $balance)
    {
        $this->balance = $balance;
        $this->memberId = $memberId;
    }

    public static function withAccountBalance(int $memberId, Money $balance): Member
    {
        return new Member($memberId, $balance);
    }

    public function id(): int
    {
        return $this->memberId;
    }

    public function accountBalance(): Money
    {
        return $this->balance;
    }

    // sender
    public function transfer(Member $recipient, Money $amount)
    {
        $this->balance = $this->balance->subtract($amount);
        $recipient->balance = $recipient->balance->add($amount); //recipient
    }

    public function equals(Member $aMember): bool
    {
        return $this->memberId === $aMember->memberId;
    }
}
