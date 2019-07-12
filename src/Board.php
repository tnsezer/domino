<?php

namespace App;

/**
 * @author Tan SEZER <t.sezer@youwe.nl>
 */
class Board
{

    /**
     * @var array
     */
    private $tiles = [];

    /**
     * @var array
     */
    private $lines = [];

    /**
     * @var Tile
     */
    private $connectedTile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->init();
    }

    private function init(): void
    {
        $range = range(0, 6);
        foreach ($range as $firstNumber) {
            for ($secondNumber = 0; $secondNumber <= $firstNumber; $secondNumber++) {
                $tile = new Tile($firstNumber, $secondNumber);
                $this->tiles[] = $tile;
            }
        }

        shuffle($this->tiles);
        $tile = $this->getTileFromDeck();
        $this->addTileToHead($tile);
    }

    /**
     * @return Tile
     */
    public function getTileFromDeck(): Tile
    {
        return array_shift($this->tiles);
    }

    /**
     * @param Tile $tile
     */
    public function addTileToEnd(Tile $tile): void
    {
        array_push($this->lines, $tile);
    }

    /**
     * @param Tile $tile
     */
    public function addTileToHead(Tile $tile): void
    {
        array_unshift($this->lines, $tile);
    }

    /**
     * @return int
     */
    public function getTileCountsOnDeck(): int
    {
        return count($this->tiles);
    }

    /**
     * @return Tile
     */
    public function getHeadTile(): Tile
    {
        return $this->lines[0];
    }

    /**
     * @return Tile
     */
    public function getEndTile(): Tile
    {
        return end($this->lines);
    }

    /**
     * @return array
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @return Tile
     */
    public function getConenctedTile(): Tile
    {
        return $this->connectedTile;
    }

    /**
     * @param Tile $tile
     *
     * @return Tile|null
     */
    public function moveTile(Tile $tile): ?Tile
    {
        $headTile = $this->getHeadTile();
        $endTile = $this->getEndTile();

        $headNumber = $headTile->getHeadNumber(); //1
        $tailNumber = $endTile->getTailNumber(); //1

        $connectedTile = null;

        if ($tile->getHeadNumber() === $headNumber || $tile->getTailNumber() === $tailNumber) {
            $tile->flip();
        }

        if ($tile->getTailNumber() === $headNumber) {
            $this->addTileToHead($tile);
            $connectedTile = $headTile;
        } else if($tile->getHeadNumber() === $tailNumber) {
            $this->addTileToEnd($tile);
            $connectedTile = $endTile;
        } else {
            return null;
        }

        $this->connectedTile = $connectedTile;

        return $tile;
    }
}
