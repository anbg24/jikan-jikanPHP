<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class AnimeImages extends \ArrayObject
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
     * @var AnimeImagesJpg
     */
    protected $jpg;

    /**
     * Available images in WEBP.
     *
     * @var AnimeImagesWebp
     */
    protected $webp;

    /**
     * Available images in JPG.
     */
    public function getJpg(): AnimeImagesJpg
    {
        return $this->jpg;
    }

    /**
     * Available images in JPG.
     */
    public function setJpg(AnimeImagesJpg $animeImagesJpg): self
    {
        $this->initialized['jpg'] = true;
        $this->jpg = $animeImagesJpg;

        return $this;
    }

    /**
     * Available images in WEBP.
     */
    public function getWebp(): AnimeImagesWebp
    {
        return $this->webp;
    }

    /**
     * Available images in WEBP.
     */
    public function setWebp(AnimeImagesWebp $animeImagesWebp): self
    {
        $this->initialized['webp'] = true;
        $this->webp = $animeImagesWebp;

        return $this;
    }
}
