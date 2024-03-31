<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class RandomUsersGetResponse200 extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];

    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }

    /**
     * @var UserProfile
     */
    protected $data;

    public function getData(): UserProfile
    {
        return $this->data;
    }

    public function setData(UserProfile $userProfile): self
    {
        $this->initialized['data'] = true;
        $this->data = $userProfile;

        return $this;
    }
}
