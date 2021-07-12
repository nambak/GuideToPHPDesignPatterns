<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\Monopoly;
use App\Player;
use App\Dollar;
use App\PropertyInfo;
use App\TestableAssessor;
use App\InvalidPropertyNameException;

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

    public function testPropertyInfo()
    {
        $list = ['type', 'price', 'color', 'rent'];

        $this->assertInstanceOf(PropertyInfo::class, $testProp = new PropertyInfo($list));

        foreach ($list as $prop) {
            $this->assertEquals($prop, $testProp->$prop);
        }
    }

    public function testPropertyInfoMissingColorRent()
    {
        $list = ['type', 'price'];

        $this->assertInstanceOf(PropertyInfo::class, $testProp = new PropertyInfo($list));

        foreach ($list as $prop) {
            $this->assertEquals($prop, $testProp->$prop);
        }

        $this->assertNull($testProp->color);
        $this->assertNull($testProp->rent);
    }

    public function testGetPropInfoReturn()
    {
        $assessor = new TestableAssessor;
        
        $this->assertInstanceOf(PropertyInfo::class, $assessor->getPropInfo('Boardwalk'));
    }

    public function testBadPropNameReturnsException()
    {
        $this->expectException(InvalidPropertyNameException::class);

        $assessor = new TestableAssessor;
        
        $assessor->getPropInfo('Main Street');
        
        
    }
}

