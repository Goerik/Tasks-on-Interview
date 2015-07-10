<?php

class Rover
{
    const N = 1;
    const E = 2;
    const S = 3;
    const W = 4;
    protected $maxX = 0;
    protected $maxY = 0;
    protected $x = 0;
    protected $y = 0;
    protected $facing = self::N;

    public function __construct($maxX, $maxY)
    {
        $this->maxX = $maxX;
        $this->maxY = $maxY;
    }


    public function setPosition($x, $y, $facing)
    {
        $this->x = $x;
        $this->y = $y;
        $this->facing = $facing;
    }


    function getPosition()
    {
        $dir = 'N';
        if ($this->facing == 1) {
            $dir = 'N';
        } else if ($this->facing == 2) {
            $dir = 'E';
        } else if ($this->facing == 3) {
            $dir = 'S';
        } else if ($this->facing == 4) {
            $dir = 'W';
        }
        return $this->x . " " . $this->y . " " . $dir;
    }

    function process($commands)
    {
        $len = mb_strlen($commands);
        for ($i = 0; $i < $len; $i++) {
            $this->processStep(mb_substr($commands, $i, 1));
        }
    }

    function processStep($command)
    {
        if ($command == 'L') {
            $this->turnLeft();
        } else if ($command == 'R') {
            $this->turnRight();
        } else if ($command == 'M') {
            $this->move();
        }
    }

    function move()
    {
        if ($this->facing == self::N) {
            $this->y++;
        } else if ($this->facing == self::E) {
            $this->x++;
        } else if ($this->facing == self::S) {
            $this->y--;
        } else if ($this->facing == self::W) {
            $this->x--;
        }
        $this->normalize();
    }


    function normalize()
    {
        $this->x = min($this->x, $this->maxX);
        $this->y = min($this->y, $this->maxY);
        $this->x = max(0, $this->x);
        $this->y = max(0, $this->y);
    }


    function turnLeft()
    {
        $this->facing = ($this->facing - 1) < self::N ? self::W : $this->facing - 1;
    }

    function turnRight()
    {
        $this->facing = ($this->facing + 1) > self::W ? self::N : $this->facing + 1;
    }
}
