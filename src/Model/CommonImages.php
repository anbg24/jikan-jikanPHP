<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class CommonImages extends \ArrayObject
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
     * @var CommonImagesJpg
     */
    protected $jpg;

    /**
     * Available images in JPG.
     */
    public function getJpg(): CommonImagesJpg
    {
        return $this->jpg;
    }

    /**
     * Available images in JPG.
     */
    public function setJpg(CommonImagesJpg $commonImagesJpg): self
    {
        $this->initialized['jpg'] = true;
        $this->jpg = $commonImagesJpg;

        return $this;
    }
}
