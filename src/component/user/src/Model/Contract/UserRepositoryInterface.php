<?php
namespace Component\User\Model\Contract;

interface UserRepositoryInterface
{
    public function get();
    public function getSettings($userId);
    public function getById($userId);
    public function getByEmail($email);
    public function getBySetting($key, $value);
}