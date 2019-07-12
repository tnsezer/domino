<?php

declare(strict_types=1);

use App\Console;
use App\Domino;
use App\Board;
use App\Player;

require_once "vendor/autoload.php";

$alice = new Player("Alice");
$bob = new Player("Bob");

$dominoGame = new Domino($alice, $bob);

Console::writeLine( $dominoGame->start() );

while (!$dominoGame->isFinished()) {
    if (! $action = $dominoGame->play()) {
        break;
    }

    Console::writeLine($dominoGame->getLastPlayed());
    Console::writeLine($dominoGame->getBoards());
}

Console::writeLine( $dominoGame->getWinner() );