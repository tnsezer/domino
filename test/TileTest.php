<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Tile;

class TileTest extends TestCase
{

    private $tile;

    public function setUp()
    {
        $this->tile = new Tile(1, 2);
    }

    public function testGetHeadNumber()
    {
        $this->assertEquals($this->tile->getHeadNumber(), 1);
    }

    public function testGetTailNumber()
    {
        $this->assertEquals($this->tile->getTailNumber(), 2);
    }

    public function testFlip()
    {
        $this->tile->flip();
        $this->assertEquals($this->tile->getTailNumber(), 1);
    }
}