<?php

class RoverTest extends PHPUnit_Framework_TestCase
{
    // standard test
    public function testRover1()
    {
        $rover = new Rover(5, 5);
        $rover->setPosition(1, 2, Rover::N);
        $rover->process("LMLMLMLMM");
        $this->assertEquals("1 3 N", $rover->getPosition());

        $rover->setPosition(3, 3, Rover::E);
        $rover->process("MMRMMRMRRM");
        $this->assertEquals("5 1 E", $rover->getPosition());
    }

    // test top of plateau (max coordinates)
    public function testRover2()
    {
        $rover = new Rover(5, 5);
        $rover->setPosition(1, 2, Rover::N);
        $rover->process("MMMMMMMMMMMM");
        $this->assertEquals("1 5 N", $rover->getPosition());

        $rover->setPosition(3, 2, Rover::S);
        $rover->process("MLMM");
        $this->assertEquals("5 1 E", $rover->getPosition());
    }

}
