<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class UserProfileFullStatistics extends \ArrayObject
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
     * Anime Statistics.
     *
     * @var UserProfileFullStatisticsAnime
     */
    protected $anime;

    /**
     * Manga Statistics.
     *
     * @var UserProfileFullStatisticsManga
     */
    protected $manga;

    /**
     * Anime Statistics.
     */
    public function getAnime(): UserProfileFullStatisticsAnime
    {
        return $this->anime;
    }

    /**
     * Anime Statistics.
     */
    public function setAnime(UserProfileFullStatisticsAnime $userProfileFullStatisticsAnime): self
    {
        $this->initialized['anime'] = true;
        $this->anime = $userProfileFullStatisticsAnime;

        return $this;
    }

    /**
     * Manga Statistics.
     */
    public function getManga(): UserProfileFullStatisticsManga
    {
        return $this->manga;
    }

    /**
     * Manga Statistics.
     */
    public function setManga(UserProfileFullStatisticsManga $userProfileFullStatisticsManga): self
    {
        $this->initialized['manga'] = true;
        $this->manga = $userProfileFullStatisticsManga;

        return $this;
    }
}
