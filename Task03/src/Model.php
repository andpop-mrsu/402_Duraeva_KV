<?php

namespace KseniaD2021\ticTacToe\Model;

use Exception as Exception;
use LogicException as LogicException;

const DEFAULT_DIMENSION = 3;
const DEFAULT_MARK = " ";
const PLAYER_X = "X";
const PLAYER_O = "O";

class Board
{
    private $size;
    private $boardArr;
    private $checkArray;
    private $userMark;
    private $computerMarkup;
    private $freeSpaceCount;

    public function __construct()
    {
        $this->size = DEFAULT_DIMENSION;
        $this->boardArr = [[]];
        $this->checkArray = [];
        $this->userMark = DEFAULT_MARK;
        $this->computerMarkup = DEFAULT_MARK;
        $this->freeSpaceCount = 0;
    }

    public function initialize()
    {
        $this->initializeBoardArr();
        $this->initializeCheckArr();
        $this->initializeMarkup();
        $this->initializeFreeSpace();
    }

    private function initializeBoardArr()
    {
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                $this->boardArr[$i][$j] = DEFAULT_MARK;
            }
        }
    }

    private function initializeCheckArr()
    {
        for ($i = 0; $i < 2 * $this->size + 2; $i++) {
            $this->checkArray[$i] = 0;
        }
    }

    private function initializeMarkup()
    {
        if (rand(0, 1) == 0) {
            $this->userMark = PLAYER_X;
            $this->computerMarkup = PLAYER_O;
        } else {
            $this->userMark = PLAYER_O;
            $this->computerMarkup = PLAYER_X;
        }
    }

    private function initializeFreeSpace()
    {
        $this->freeSpaceCount = pow($this->size, 2);
    }

    public function determineWinner($i, $j)
    {
        if (
            $this->checkArray[$i] == $this->size ||
            $this->checkArray[$this->size + $j] == $this->size
        ) {
            return PLAYER_X;
        } elseif (
            $this->checkArray[$i] == -$this->size ||
            $this->checkArray[$this->size + $j] == -$this->size
        ) {
            return PLAYER_O;
        }
        if (
            $this->checkArray[2 * $this->size] == $this->size ||
            $this->checkArray[2 * $this->size + 1] == $this->size
        ) {
            return PLAYER_X;
        } elseif (
            $this->checkArray[2 * $this->size] == -$this->size ||
            $this->checkArray[2 * $this->size + 1] == -$this->size
        ) {
            return PLAYER_O;
        } else {
            return "";
        }
    }

    public function setMarkupOnBoard($i, $j, $mark)
    {
        if ($this->isCoordsCorrect($i, $j)) {
            if ($this->isSetPossible($i, $j)) {
                $this->boardArr[$i][$j] = $mark;
                $this->updateCheckArray($i, $j, $mark);
                $this->freeSpaceCount--;
            } else {
                throw new Exception("Это поле уже занято. Попробуйте снова.");
            }
        } else {
            throw new Exception("Введены неверные координаты. Попробуйте еще раз.");
        }
    }

    private function isCoordsCorrect($i, $j)
    {
        return is_numeric($i) && is_numeric($j) && $i >= 0 && $i < $this->size && $j >= 0 && $j < $this->size;
    }

    private function isSetPossible($i, $j)
    {
        if ($this->boardArr[$i][$j] === DEFAULT_MARK) {
            return true;
        } else {
            return false;
        }
    }

    private function updateCheckArray($i, $j, $mark)
    {
        $offset = 1;
        if ($mark == PLAYER_O) {
            $offset = -1;
        }
        $this->checkArray[$i] += $offset;
        $this->checkArray[$this->size + $j] += $offset;
        if (($i == $j) && ($i == ($this->size - 1 - $j))) {
            $this->checkArray[2 * $this->size] += $offset;
            $this->checkArray[2 * $this->size + 1] += $offset;
        } elseif ($i == $j) {
            $this->checkArray[2 * $this->size] += $offset;
        } elseif ($i == ($this->size - 1 - $j)) {
            $this->checkArray[2 * $this->size + 1] += $offset;
        }
    }

    public function getBoardArr()
    {
        return $this->boardArr;
    }

    public function setSize($dimension)
    {
        if (is_numeric($dimension) && $dimension >= 3 && $dimension <= 10) {
            return $this->size = $dimension;
        } else {
            throw new Exception("Неверно введенный размер поля. Размер от 3 до 10. Попробуйте еще раз.");
        }
    }

    public function getDimension()
    {
        return $this->size;
    }

    public function getMark()
    {
        return $this->userMark;
    }

    public function computerMark()
    {
        return $this->computerMarkup;
    }

    public function freeSpaceEnough()
    {
        return $this->freeSpaceCount !== 0;
    }
}
