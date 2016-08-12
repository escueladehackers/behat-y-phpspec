<?php
use Behat\Behat\Context\{Context, SnippetAcceptingContext};
use Ewallet\Members\{InMemoryMembers, Member, Members};
use Money\Money;

/**
 * Defines application features from the specific context.
 */
class MembersContext implements Context, SnippetAcceptingContext
{
    use MembersDictionary;

    /** @var Member */
    private $i;

    /** @var Member */
    private $myFriend;

    /** @var Members */
    private $members;

    /**
     * Initializes context.
     */
    public function __construct()
    {
        $this->members = new InMemoryMembers();
    }

    /**
     * @Given I'm a member with an account balance of :amount MXN
     */
    public function iMAMemberWithAnAccountBalanceOfMxn(Money $amount)
    {
        $this->i = Member::withAccountBalance(1, $amount);
        $this->members->add($this->i);
    }

    /**
     * @Given my friend has an account balance of :amount MXN
     */
    public function myFriendHasAnAccountBalanceOfMxn(Money $amount)
    {
        $this->myFriend = Member::withAccountBalance(2, $amount);
        $this->members->add($this->myFriend);
    }

    /**
     * @When I transfer him :amount MXN
     */
    public function iTransferHimMxn(Money $amount)
    {
        $this->i->transfer($this->myFriend, $amount);
        $this->members->update($this->i);
        $this->members->update($this->myFriend);
    }

    /**
     * @Then I should be notified that the transfer is complete
     */
    public function iShouldBeNotifiedThatTheTransferIsComplete()
    {
        //
    }

    /**
     * @Then my balance should be :amount MXN
     */
    public function myBalanceShouldBeMxn(Money $amount)
    {
        $my = $this->members->with($this->i->id());
        if (!$my->accountBalance()->equals($amount)) {
            throw new RuntimeException(
                "Final balance does not match, expecting {$amount->getAmount()}, found {$this->i->accountBalance()->getAmount()}"
            );
        }
    }

    /**
     * @Then my friend's balance should be :amount MXN
     */
    public function myFriendSBalanceShouldBeMxn(Money $amount)
    {
        $myFriend = $this->members->with($this->myFriend->id());
        if (!$myFriend->accountBalance()->equals($amount)) {
            throw new RuntimeException(
                "Final balance does not match, expecting {$amount->getAmount()}, found {$this->myFriend->accountBalance()->getAmount()}"
            );
        }
    }
}
