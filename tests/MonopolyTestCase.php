<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Monopoly;
use App\Player;
use App\Dollar;

final class MonopolyTestCase extends TestCase
{
    public function testGame(): void
    {
        $game = new Monopoly;
        
        $player1 = new Player('Jason');
        $this->assertEquals(1500, $player1->getBalance());

        $game->passGo($player1);
        $this->assertEquals(1700, $player1->getBalance());

        $game->passGo($player1);
        $this->assertEquals(1900, $player1->getBalance());

    }

    public function testRent(): void
    {
        $game = new Monopoly;
        $player1 = new Player('Madeline');
        $player2 = new Player('Caleb');

        $this->assertEquals(1500, $player1->getBalance());
        $this->assertEquals(1500, $player2->getBalance());

        $game->payRent($player1, $player2, new Dollar(26));

        $this->assertEquals(1474, $player1->getBalance());
        $this->assertEquals(1526, $player2->getBalance());
    }
}

