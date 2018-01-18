<?php

namespace Hexomino;

class Cube
{
    private $front;
    private $rear;
    private $left;
    private $right;
    private $top;
    private $bottom;

    public function __construct(int $front, int $rear, int $left, int $right, int $top, int $bottom)
    {
        $this->front = $front;
        $this->rear = $rear;
        $this->left = $left;
        $this->right = $right;
        $this->top = $top;
        $this->bottom = $bottom;
    }

    public function isIdentical(Cube $anotherCube): bool
    {
        if ($this->front != $anotherCube->front) return false;
        if ($this->rear != $anotherCube->rear) return false;
        if ($this->left != $anotherCube->left) return false;
        if ($this->right != $anotherCube->right) return false;
        if ($this->top != $anotherCube->top) return false;
        if ($this->bottom != $anotherCube->bottom) return false;
        return true;
    }

    public function rotateLeft(): void
    {
        $newFront = $this->right;
        $newRear = $this->left;
        $newLeft = $this->front;
        $newRight = $this->rear;
        $this->front = $newFront;
        $this->rear = $newRear;
        $this->left = $newLeft;
        $this->right = $newRight;
    }

    public function rotateRight(): void
    {
        $newFront = $this->left;
        $newRear = $this->right;
        $newLeft = $this->rear;
        $newRight = $this->front;
        $this->front = $newFront;
        $this->rear = $newRear;
        $this->left = $newLeft;
        $this->right = $newRight;
    }

    public function rotateUp(): void
    {
        $newFront = $this->bottom;
        $newRear = $this->top;
        $newTop = $this->front;
        $newBottom = $this->rear;
        $this->front = $newFront;
        $this->rear = $newRear;
        $this->top = $newTop;
        $this->bottom = $newBottom;
    }

    public function rotateDown(): void
    {
        $newFront = $this->top;
        $newRear = $this->bottom;
        $newTop = $this->rear;
        $newBottom = $this->front;
        $this->front = $newFront;
        $this->rear = $newRear;
        $this->top = $newTop;
        $this->bottom = $newBottom;
    }

    public function rotateClockwise(): void
    {
        $newRight = $this->top;
        $newLeft = $this->bottom;
        $newTop = $this->left;
        $newBottom = $this->right;
        $this->left = $newLeft;
        $this->right = $newRight;
        $this->top = $newTop;
        $this->bottom = $newBottom;
    }


    public function rotateCounterclockwise(): void
    {
        $newRight = $this->bottom;
        $newLeft = $this->top;
        $newTop = $this->right;
        $newBottom = $this->left;
        $this->left = $newLeft;
        $this->right = $newRight;
        $this->top = $newTop;
        $this->bottom = $newBottom;
    }

    public function rotateFacetToFront(int $facet)
    {
        if ($facet === $this->front) return;
        if ($facet === $this->rear) {
            $this->rotateLeft();
            $this->rotateLeft();
            return;
        }
        if ($facet === $this->left) {
            $this->rotateRight();
            return;
        }
        if ($facet === $this->right) {
            $this->rotateLeft();
            return;
        }
        if ($facet === $this->top) {
            $this->rotateDown();
            return;
        }
        if ($facet === $this->bottom) {
            $this->rotateUp();
            return;
        }
        throw new \RuntimeException('Cube does not have ' . $facet . ' on any facet');
    }

    public function rotateFacetToTopKeepingTheFrontOne(int $facet)
    {
        if ($facet === $this->top) return;
        if ($facet === $this->front) {
            throw new \RuntimeException('Impossible to align this Cube');
        }
        if ($facet === $this->rear) {
            throw new \RuntimeException('Impossible to align this Cube');
        }

        if ($facet === $this->left) {
            $this->rotateClockwise();
            return;
        }
        if ($facet === $this->right) {
            $this->rotateCounterclockwise();
            return;
        }

        if ($facet === $this->bottom) {
            $this->rotateCounterclockwise();
            $this->rotateCounterclockwise();
            return;
        }
        throw new \RuntimeException('Cube does not have ' . $facet . ' on any facet');
    }

    public function isEquivalent(Cube $anotherCube): bool
    {
        try {
            $anotherCube->rotateFacetToFront($this->front);
            $anotherCube->rotateFacetToTopKeepingTheFrontOne($this->top);
        } catch (\RuntimeException $exception) {
            return false;
        }
        return $this->isIdentical($anotherCube);
    }

    public function __toString()
    {
        $string = 'front: ' . $this->front;
        $string .= ' rear: ' . $this->rear;
        $string .= ' left: ' . $this->left;
        $string .= ' right: ' . $this->right;
        $string .= ' top: ' . $this->top;
        $string .= ' bottom: ' . $this->bottom . PHP_EOL;
        return $string;
    }
}