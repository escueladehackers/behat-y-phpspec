<?php
/**
 * PHP version 7.0
 *
 * This source file is subject to the license that is bundled with this package in the file LICENSE.
 */
namespace Ewallet\Members;

use Doctrine\ORM\EntityRepository;

class MembersRepository extends EntityRepository implements Members
{
    public function add(Member $member)
    {
        $this->_em->persist($member);
        $this->_em->flush();
    }

    public function update(Member $member)
    {
        $this->_em->persist($member);
        $this->_em->flush();
    }

    public function with(int $id): Member
    {
        $builder = $this->createQueryBuilder('m');

        $builder
            ->where('m.memberId = :memberId')
            ->setParameter('memberId', $id)
        ;

        return $builder->getQuery()->getOneOrNullResult();
    }
}
