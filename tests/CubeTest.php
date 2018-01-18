<?php

namespace Hexomino\Tests;

use Hexomino\Cube;
use PHPUnit\Framework\TestCase;

class CubeTest extends TestCase
{
    public function testPhpUnit()
    {
        $this->assertTrue(true);
    }

    public function testTwoCubesWithSameValuesInConstructorAreIdentical()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $anotherCube = new Cube(1, 2, 3, 4, 5, 6);
        $this->assertTrue($cube->isIdentical($anotherCube));
    }

    public function testTwoCubesWithDifferentValuesInConstructorAreNotIdentical()
    {
        $cube = new Cube(6, 2, 3, 4, 5, 1);
        $anotherCube = new Cube(1, 2, 3, 4, 5, 6);
        $this->assertFalse($cube->isIdentical($anotherCube));
    }

    public function testRotateLeft()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $rotatedCube = new Cube(4, 3, 1, 2, 5, 6);
        $cube->rotateLeft();
        $this->assertTrue($cube->isIdentical($rotatedCube));
    }

    public function testRotateRight()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $rotatedCube = new Cube(3, 4, 2, 1, 5, 6);
        $cube->rotateRight();
        $this->assertTrue($cube->isIdentical($rotatedCube));
    }

    public function testRotateLeftIsTheSameAsThreeTimesRotateRight()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $anotherCube = new Cube(1, 2, 3, 4, 5, 6);
        $cube->rotateRight();
        $cube->rotateRight();
        $cube->rotateRight();
        $anotherCube->rotateLeft();
        $this->assertTrue($cube->isIdentical($anotherCube));
    }

    public function testRotateUp()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $rotatedCube = new Cube(6, 5, 3, 4, 1, 2);
        $cube->rotateUp();
        $this->assertTrue($cube->isIdentical($rotatedCube));
    }

    public function testRotateDown()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $rotatedCube = new Cube(5, 6, 3, 4, 2, 1);
        $cube->rotateDown();
        $this->assertTrue($cube->isIdentical($rotatedCube));
    }

    public function testRotateDownIsSameAsRotateUpThreeTimes()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $anotherCube = new Cube(1, 2, 3, 4, 5, 6);
        $cube->rotateDown();
        $anotherCube->rotateUp();
        $anotherCube->rotateUp();
        $anotherCube->rotateUp();
        $this->assertTrue($cube->isIdentical($anotherCube));
    }

    public function testRotateClockwise()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $rotatedCube = new Cube(1, 2, 6, 5, 3, 4);
        $cube->rotateClockwise();
        $this->assertTrue($cube->isIdentical($rotatedCube));
    }

    public function testRotateCounterclockwise()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $rotatedCube = new Cube(1, 2, 5, 6, 4, 3);
        $cube->rotateCounterclockwise();
        $this->assertTrue($cube->isIdentical($rotatedCube));
    }


    public function testRotateClockwiseIsSameAsRotateCounterclowiseThreeTimes()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $anotherCube = new Cube(1, 2, 3, 4, 5, 6);
        $cube->rotateClockwise();
        $anotherCube->rotateCounterclockwise();
        $anotherCube->rotateCounterclockwise();
        $anotherCube->rotateCounterclockwise();
        $this->assertTrue($cube->isIdentical($anotherCube));
    }

    public function testIdenticalCubesAreEquivalents()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $anotherCube = new Cube(1, 2, 3, 4, 5, 6);
        $this->assertTrue($cube->isEquivalent($anotherCube));
    }

    public function testRotatedCubeIsEquivalent()
    {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $anotherCube = new Cube(1, 2, 3, 4, 5, 6);
        $anotherCube->rotateUp();
        $this->assertTrue($cube->isEquivalent($anotherCube));
        $anotherCube->rotateUp();
        $anotherCube->rotateUp();
        $this->assertTrue($cube->isEquivalent($anotherCube));
        $anotherCube->rotateCounterclockwise();
        $anotherCube->rotateCounterclockwise();
        $this->assertTrue($cube->isEquivalent($anotherCube));
        $anotherCube->rotateClockwise();
        $this->assertTrue($cube->isEquivalent($anotherCube));
        $anotherCube->rotateLeft();
        $this->assertTrue($cube->isEquivalent($anotherCube));
        $anotherCube->rotateRight();
        $this->assertTrue($cube->isEquivalent($anotherCube));
    }
    public function testDifferentCubesAreNotEquivalents() {
        $cube = new Cube(1, 2, 3, 4, 5, 6);
        $cube1 = new Cube(2, 1, 3, 4, 5, 6);
        $cube2 = new Cube(2, 1, 6, 4, 5, 3);
        $cube3 = new Cube(1, 2, 3, 4, 6, 5);
        $cube4 = new Cube(6, 1, 3, 4, 5, 1);
        $this->assertFalse($cube->isEquivalent($cube1));
        $this->assertFalse($cube->isEquivalent($cube2));
        $this->assertFalse($cube->isEquivalent($cube3));
        $this->assertFalse($cube->isEquivalent($cube4));
    }
}
