<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
use Ewallet\Alice\TwoMembersWithDifferentBalances;
use Ewallet\Doctrine\EntityManagerSetup;

class TransferFundsCest
{
    use EntityManagerSetup;

    public function _before()
    {
        $this->_setUpDoctrine(require __DIR__ . '/../../config.php');
        $fixture = new TwoMembersWithDifferentBalances($this->entityManager);
        $fixture->load();
    }

    public function tryToTransferFundsBetweenMembers(AcceptanceTester $I)
    {
        $I->am('ewallet member');
        $I->wantTo('pay a debt');
        $I->lookForwardTo('transfer funds to my friend');

        $I->amOnTransferFundsPage();
        $I->enterTransferInformation(1, 5);
        $I->requestTransfer();

        $I->seeTransferCompletedConfirmation();
    }
}
