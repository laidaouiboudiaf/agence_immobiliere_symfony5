<?php
namespace App\Entity;

class OwnerSearch {

    private $maxPrice;

    /**
     * @var int|null
     */
    private $mixSurface;

    /**
     * @return int|null
     */
    public function getMixSurface(): ?int
    {
        return $this->mixSurface;
    }

    /**
     * @param int|null $mixSurface
     */
    public function setMixSurface(int $mixSurface): void
    {
        $this->mixSurface = $mixSurface;
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int|null $maxPrice
     */
    public function setMaxPrice( int $maxPrice): OwnerSearch
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }


}