<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class CharacterImages extends \ArrayObject
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
     * @var CharacterImagesJpg
     */
    protected $jpg;

    /**
     * Available images in WEBP.
     *
     * @var CharacterImagesWebp
     */
    protected $webp;

    /**
     * Available images in JPG.
     */
    public function getJpg(): CharacterImagesJpg
    {
        return $this->jpg;
    }

    /**
     * Available images in JPG.
     */
    public function setJpg(CharacterImagesJpg $characterImagesJpg): self
    {
        $this->initialized['jpg'] = true;
        $this->jpg = $characterImagesJpg;

        return $this;
    }

    /**
     * Available images in WEBP.
     */
    public function getWebp(): CharacterImagesWebp
    {
        return $this->webp;
    }

    /**
     * Available images in WEBP.
     */
    public function setWebp(CharacterImagesWebp $characterImagesWebp): self
    {
        $this->initialized['webp'] = true;
        $this->webp = $characterImagesWebp;

        return $this;
    }
}
