<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
use Money\Money;

trait MembersDictionary
{
    /**
     * @Transform :amount
     */
    public function convertFromStringToMoney($amount): Money
    {
        return Money::MXN($amount * 100);
    }
}
