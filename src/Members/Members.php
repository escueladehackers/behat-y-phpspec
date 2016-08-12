<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Members;

interface Members
{
    public function add(Member $member);
    public function update(Member $member);
    public function with(int $id): Member;
}
