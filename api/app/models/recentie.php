<?php
namespace Models;

class Recentie
{

    public int $id;
    public int $bedrijfsId;
    public int $userId;
    public string $title;
    public string $beschrijving;
    public int $rating;
    public ReactieDTO $reactie;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getBedrijfsId(): int
    {
        return $this->bedrijfsId;
    }

    /**
     * @param int $bedrijfsId
     */
    public function setBedrijfsId(int $bedrijfsId): void
    {
        $this->bedrijfsId = $bedrijfsId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBeschrijving(): string
    {
        return $this->beschrijving;
    }

    /**
     * @param string $beschrijving
     */
    public function setBeschrijving(string $beschrijving): void
    {
        $this->beschrijving = $beschrijving;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return ReactieDTO
     */
    public function getReactie(): ReactieDTO
    {
        return $this->reactie;
    }

    /**
     * @param ReactieDTO $reactie
     */
    public function setReactie(ReactieDTO $reactie): void
    {
        $this->reactie = $reactie;
    }


  
}
