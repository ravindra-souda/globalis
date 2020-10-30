<?php


use PHPUnit\Framework\TestCase;

class ContinentTest extends TestCase
{
    public function testHasValidWidth(): void
    {
        $continent = new Continent(0, '1 2 3');
        $this->assertFalse($continent->runSimulation(), 'width should not be less than 1');

        $continent = new Continent(100001, implode(' ', range(1, 100001)));
        $this->assertFalse($continent->runSimulation(), 'width should not be greater than 100000');
    }

    public function testHasValidHeights(): void
    {
        $continent = new Continent(3, '0 -1 100000');
        $this->assertFalse($continent->runSimulation(), 'heights should not be less than 0');

        $continent = new Continent(3, '0 1 100001');
        $this->assertFalse($continent->runSimulation(), 'heights should not be greater than 100000');

        $continent = new Continent(3, '0 error 100000');
        $this->assertFalse($continent->runSimulation(), 'heights must be numeric');

        $continent = new Continent(3, '0 3.14 100000');
        $this->assertFalse($continent->runSimulation(), 'heights must be integers');

        $continent = new Continent(3, '0 314 100000 42');
        $this->assertFalse($continent->runSimulation(), 'count(heights) and width should be equal');
    }

    public function testExample(): void
    {
        $continent = new Continent(10, '30 27 17 42 29 12 14 41 42 42');
        $this->assertTrue($continent->runSimulation(), 'example must pass');
        $this->assertEquals(6, $continent->getSafeSpots(), 'example must return 6 safe spots');
    }
}
