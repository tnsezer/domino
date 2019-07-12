<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Tile;
use App\Player;

class PlayerTest extends TestCase
{
    private $player;

    public function setUp()
    {
        $this->player = new Player('Test');
    }

    public function testGetName()
    {
        $this->assertEquals($this->player->getName(), 'Test');
    }

    public function testGetTiles()
    {
        $tile = new Tile(1, 2);
        $this->player->addTile($tile);
        $this->assertEquals($this->player->getTiles(), [$tile]);
    }

    public function testGetLastPlayedTile()
    {
        $tile = new Tile(1, 2);

        $this->player->addTile($tile);
        $this->player->playedTile($tile);

        $this->assertEquals($this->player->getLastPlayedTile(), $tile);
    }
}