<?php declare(strict_types=1);

$animeVideosModel = __DIR__ . '/../src/Model/AnimeVideos.php';

$contents = file_get_contents($animeVideosModel);

if ($contents === false) {
    throw new RuntimeException('Unable to read AnimeVideos model.');
}

$search = <<<'SEARCH'
    /**
     * @var AnimeVideosData
     */
    protected $data;

    public function getData(): AnimeVideosData
    {
        return $this->data;
    }

    public function setData(AnimeVideosData $animeVideosData): self
    {
        $this->initialized['data'] = true;
        $this->data = $animeVideosData;
SEARCH;

$replace = <<<'REPLACE'
    /**
     * @var AnimeVideosData|null
     */
    protected $data;

    public function getData(): ?AnimeVideosData
    {
        return $this->data ?? null;
    }

    public function setData(?AnimeVideosData $animeVideosData): self
    {
        $this->initialized['data'] = true;
        $this->data = $animeVideosData;
REPLACE;

$updated = str_replace($search, $replace, $contents, $count);

if ($count !== 1) {
    throw new RuntimeException('AnimeVideos nullability patch did not match generated source.');
}

if (file_put_contents($animeVideosModel, $updated) === false) {
    throw new RuntimeException('Unable to write AnimeVideos model.');
}
