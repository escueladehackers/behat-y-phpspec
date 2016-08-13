<?php
use Page\TransferFundsPage;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function amOnTransferFundsPage()
    {
        $this->amOnPage(TransferFundsPage::$inputTransferInformationPage);
    }
    /**
     * @param int $recipientId Recipient's ID
     * @param int $amount Amount in MXN
     */
    public function enterTransferInformation(int $recipientId, int $amount)
    {
        $this->fillField(TransferFundsPage::$recipients, $recipientId);
        $this->fillField(TransferFundsPage::$amount, $amount);
    }

    public function requestTransfer()
    {
        $this->click(TransferFundsPage::$transferButton);
    }

    public function seeTransferCompletedConfirmation()
    {
        $this->seeCurrentUrlMatches(TransferFundsPage::$transferCompletedPage . '/');
        $this->seeElement(TransferFundsPage::$successMessage);
    }
}
