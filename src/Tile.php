<?php

namespace App;

class Tile
{
    /**
     * @var int
     */
    private $headNumber;

    /**
     * @var int
     */
    private $tailNumber;

    public function __construct(int $headNumber, int $tailNumber)
    {
        $this->headNumber = $headNumber;
        $this->tailNumber = $tailNumber;
    }

    public function __toString(): string
    {
        return '<' . $this->headNumber . ':' . $this->tailNumber . '>';
    }

    /**
     * @return int
     */
    public function getHeadNumber(): int
    {
        return $this->headNumber;
    }

    /**
     * @return int
     */
    public function getTailNumber(): int
    {
        return $this->tailNumber;
    }

    public function flip(): void
    {
        $temp = $this->headNumber;
        $this->headNumber = $this->tailNumber;
        $this->tailNumber = $temp;
    }
}