<?php
namespace Component\User\Service;

use Component\User\Model\Repository\UserRepository;
use Component\User\UserException;
use Silex\Application;

class UserService
{
    /** @var Application */
    protected $app;

    /** @var UserRepository */
    protected $repository;

    public function __construct(Application $app, UserRepository $repository)
    {
        $this->app        = $app;
        $this->repository = $repository;
    }

    public function listUsers()
    {

    }

    public function getUserSettings($userId)
    {
        return $this->repository->getSettings($userId);
    }

    public function findUserById($userId)
    {
        return $this->repository->getById($userId);
    }

    public function findUserByEmail($email)
    {
        return $this->repository->getByEmail($email);
    }

    public function findUserBySetting($key, $value)
    {
        $user = $this->repository->getBySetting($key, $value);

        if (!$user)
        {
            throw new UserException('User not found');
        }

        return $user;
    }
}