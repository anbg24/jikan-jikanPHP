<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class UserImages extends \ArrayObject
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
     * Available images in JPG.
     *
     * @var UserImagesJpg
     */
    protected $jpg;

    /**
     * Available images in WEBP.
     *
     * @var UserImagesWebp
     */
    protected $webp;

    /**
     * Available images in JPG.
     */
    public function getJpg(): UserImagesJpg
    {
        return $this->jpg;
    }

    /**
     * Available images in JPG.
     */
    public function setJpg(UserImagesJpg $userImagesJpg): self
    {
        $this->initialized['jpg'] = true;
        $this->jpg = $userImagesJpg;

        return $this;
    }

    /**
     * Available images in WEBP.
     */
    public function getWebp(): UserImagesWebp
    {
        return $this->webp;
    }

    /**
     * Available images in WEBP.
     */
    public function setWebp(UserImagesWebp $userImagesWebp): self
    {
        $this->initialized['webp'] = true;
        $this->webp = $userImagesWebp;

        return $this;
    }
}
