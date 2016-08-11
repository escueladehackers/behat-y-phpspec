<?php
namespace Ewallet\Members;

class Member
{
    /** @var int */
    private $balance;

    private function __construct(int $balance)
    {
        $this->balance = $balance;
    }

    public static function withAccountBalance(int $balance): Member
    {
        return new Member($balance);
    }

    public function accountBalance(): int
    {
        return $this->balance;
    }

    // sender
    public function transfer(Member $recipient, int $amount)
    {
        $this->balance -= $amount;
        $recipient->balance += $amount; //recipient
    }
}
