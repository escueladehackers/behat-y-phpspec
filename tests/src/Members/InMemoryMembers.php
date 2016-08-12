<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Members;

class InMemoryMembers implements Members
{
    /** @var array */
    private $members = [];

    public function add(Member $member)
    {
        $this->members[] = $member;
    }

    public function update(Member $member)
    {
        /**
         * @var int $i
         * @var Member $knownMember
         */
        foreach ($this->members as $i => $knownMember) {
            if ($knownMember->equals($member)) {
                $this->members[$i] = $member;
            }
        }
    }

    public function with(int $id): Member
    {
        /** @var Member $member */
        foreach ($this->members as $member) {
            if ($member->id() === $id) {
                return $member;
            }
        }
    }
}
