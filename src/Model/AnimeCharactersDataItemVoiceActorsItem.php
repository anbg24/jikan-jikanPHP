<?php declare(strict_types=1);

namespace Jikan\JikanPHP\Model;

class AnimeCharactersDataItemVoiceActorsItem extends \ArrayObject
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
     * @var AnimeCharactersDataItemVoiceActorsItemPerson
     */
    protected $person;

    /**
     * @var string
     */
    protected $language;

    public function getPerson(): AnimeCharactersDataItemVoiceActorsItemPerson
    {
        return $this->person;
    }

    public function setPerson(AnimeCharactersDataItemVoiceActorsItemPerson $animeCharactersDataItemVoiceActorsItemPerson): self
    {
        $this->initialized['person'] = true;
        $this->person = $animeCharactersDataItemVoiceActorsItemPerson;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->initialized['language'] = true;
        $this->language = $language;

        return $this;
    }
}
