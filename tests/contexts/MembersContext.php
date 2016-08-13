<?php
use Behat\Behat\Context\{Context, SnippetAcceptingContext};
use Ewallet\ManageWallet\TransferFunds;
use Ewallet\Members\{InMemoryMembers, Member, Members};
use Money\Money;

/**
 * Defines application features from the specific context.
 */
class MembersContext implements Context, SnippetAcceptingContext
{
    use MembersDictionary;

    /** @var int */
    private $senderId = 1;

    /** @var int */
    private $recipientId = 2;

    /** @var Members */
    private $members;

    /** @var TransferFunds */
    private $action;

    /**
     * Initializes context.
     */
    public function __construct()
    {
        $this->members = new InMemoryMembers();
        $this->action = new TransferFunds($this->members);
    }

    /**
     * @Given I'm a member with an account balance of :amount MXN
     */
    public function iMAMemberWithAnAccountBalanceOfMxn(Money $amount)
    {
        $this->members->add(Member::withAccountBalance($this->senderId, $amount));
    }

    /**
     * @Given my friend has an account balance of :amount MXN
     */
    public function myFriendHasAnAccountBalanceOfMxn(Money $amount)
    {
        $this->members->add(Member::withAccountBalance($this->recipientId, $amount));
    }

    /**
     * @When I transfer him :amount MXN
     */
    public function iTransferHimMxn(Money $amount)
    {
        $this->action->transfer($this->senderId, $this->recipientId, $amount);
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
        $my = $this->members->with($this->senderId);
        $this->assertAmountsAreEqual($amount, $my->accountBalance());
    }

    /**
     * @Then my friend's balance should be :amount MXN
     */
    public function myFriendSBalanceShouldBeMxn(Money $amount)
    {
        $myFriend = $this->members->with($this->recipientId);
        $this->assertAmountsAreEqual($amount, $myFriend->accountBalance());
    }

    /**
     * @param Money $expectedAmount
     * @param Money $actualAmount
     */
    private function assertAmountsAreEqual(Money $expectedAmount, Money $actualAmount)
    {
        assertTrue(
            $actualAmount->equals($expectedAmount),
            sprintf(
                'Final balance does not match, expecting %.2f, found %.2f',
                $expectedAmount->getAmount() / 100,
                $actualAmount->getAmount() / 100
            )
        );
    }
}
