<?php
/**
 * Created by PhpStorm.
 * User: pro
 * Date: 2019-04-03
 * Time: 19:29
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class UserRepository extends EntityRepository
{
    public $user;

    public function createAlphabeticalQueryBuilder()
    {
        return $this->createQueryBuilder('user')
            ->orderBy('user.name', 'ASC');
    }

    public function getUserId()
    {
        $session = new Session();
        $userId = $session->get('userId');

        return $this->createQueryBuilder('users')
            ->where('users.id = :userId')
            ->setParameter('userId', $userId);
    }


}