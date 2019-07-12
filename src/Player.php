<?php

namespace App;

class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $tiles = [];

    /**
     * @var Tile
     */
    private $playedTiles = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addTile(Tile $tile): void
    {
        $this->tiles[] = $tile;
    }

    /**
     * @return Tile[]
     */
    public function getTiles(): array
    {
        return $this->tiles;
    }

    /**
     * @return Tile
     */
    public function getLastPlayedTile(): Tile
    {
        return end($this->playedTiles);
    }

    /**
     * @param Tile $tile
     */
    public function playedTile(Tile $tile): void
    {
        $this->playedTiles[] = $tile;

        if (($key = array_search($this->getLastPlayedTile(), $this->tiles)) !== false) {
            unset($this->tiles[$key]);
        }
    }
}