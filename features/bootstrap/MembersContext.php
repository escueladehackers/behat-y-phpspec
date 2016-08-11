<?php
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Ewallet\Members\Member;

/**
 * Defines application features from the specific context.
 */
class MembersContext implements Context, SnippetAcceptingContext
{
    private $i;
    private $myFriend;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I'm a member with an account balance of :amount MXN
     */
    public function iMAMemberWithAnAccountBalanceOfMxn($amount)
    {
        $this->i = Member::withAccountBalance($amount);
    }

    /**
     * @Given my friend has an account balance of :amount MXN
     */
    public function myFriendHasAnAccountBalanceOfMxn($amount)
    {
        $this->myFriend = Member::withAccountBalance($amount);
    }

    /**
     * @When I transfer him :amount MXN
     */
    public function iTransferHimMxn($amount)
    {
        $this->i->transfer($this->myFriend, $amount);
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
    public function myBalanceShouldBeMxn($amount)
    {
        if ($this->i->accountBalance() != $amount) {
            throw new RuntimeException("Final balance does not match, expecting $amount");
        }
    }

    /**
     * @Then my friend's balance should be :amount MXN
     */
    public function myFriendSBalanceShouldBeMxn($amount)
    {
        if ($this->myFriend->accountBalance() != $amount) {
            throw new RuntimeException("Final balance does not match, expecting $amount");
        }
    }
}
