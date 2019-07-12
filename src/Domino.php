<?php

namespace App;

/**
 * @author Tan SEZER <t.sezer@youwe.nl>
 */
class Domino
{

    /**
     * @var Player[]
     */
    private $players = [];

    /**
     * @var int
     */
    private $activePlayer = 0;

    /**
     * @var Board
     */
    private $board;

    /**
     * Constructor
     *
     * @param Player $player1
     * @param Player $player2
     */
    public function __construct(Player $player1, Player $player2)
    {
        $this->board = new Board();
        $this->players = [$player1, $player2];
    }

    /**
     * @return string
     */
    public function start(): string
    {
        $this->dealTiles();

        return $this->getStarting();
    }

    private function dealTiles(): void
    {
        foreach ($this->getPlayers() as $index => $player) {
            for ($i = 0; $i < 7; $i++) {
                $player->addTile($this->board->getTileFromDeck());
            }
        }
    }

    /**
     * @return Player[]
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @return Player
     */
    private function getActivePlayer(): Player
    {
        return $this->players[$this->activePlayer];
    }

    /**
     * @return Player
     */
    private function nextPlayer(): Player
    {
        $this->activePlayer++;

        if ($this->activePlayer >= count($this->players)) {
            $this->activePlayer = 0;
        }

        return $this->getActivePlayer();
    }

    /**
     * @return Player
     */
    private function previousPlayer(): Player
    {
        $previousPlayer = $this->activePlayer - 1;

        if ($previousPlayer < 0) {
            $previousPlayer = count($this->players) - 1;
        }

        return $this->players[$previousPlayer];
    }

    /**
     * @return bool
     */
    public function play(): bool
    {
        $playedTile = null;
        $activePlayer = $this->getActivePlayer();
        $tilesOfPlayer = $activePlayer->getTiles();
        foreach ($tilesOfPlayer as $tile) {
            if ( $playedTile = $this->board->moveTile($tile) ) {
                break;
            }
        }

        while ($playedTile === null) {

            if ($this->board->getTileCountsOnDeck() <= 0) {
                $this->nextPlayer();

                return false;
            }

            $tileFromDeck = $this->board->getTileFromDeck();
            $playedTile = $this->board->moveTile($tileFromDeck);
            if ($playedTile === null) {
                $activePlayer->addTile($tileFromDeck);
            }
        }

        $activePlayer->playedTile($playedTile);
        if (count($activePlayer->getTiles()) <= 0) {

            return false;
        }

        $this->nextPlayer();

        return true;
    }

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return $this->board->getTileCountsOnDeck() <= 0 || count($this->getActivePlayer()->getTiles()) <= 0;
    }

    /**
     * @return string
     */
    public function getWinner(): string
    {
        if ($this->isFinished()) {
            return 'Player ' . $this->getActivePlayer()->getName() . ' won!';
        }

        return '';
    }

    /**
     * @return string
     */
    private function getStarting(): string
    {
        return 'Game starting with first tile: ' . $this->board->getHeadTile();
    }

    /**
     * @return string
     */
    public function getBoards(): string
    {
        return 'Board is now: ' . implode(' ', $this->board->getLines());
    }

    /**
     * @return string
     */
    public function getLastPlayed(): string
    {
        return $this->getActivePlayer()->getName() . ' plays ' . $this->previousPlayer()->getLastPlayedTile() . ' to connect to tile ' . $this->board->getConenctedTile() . ' on the board';
    }
}
