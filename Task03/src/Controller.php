<?php

namespace KseniaD2021\ticTacToe\Controller;

 use KseniaD2021\ticTacToe\Model\Board as Board;
 use Exception as Exception;
 use LogicException as LogicException;

 use function KseniaD2021\ticTacToe\View\showList;
 use function KseniaD2021\ticTacToe\View\showReplay;
 use function KseniaD2021\ticTacToe\View\showGameBoard;
 use function KseniaD2021\ticTacToe\View\showMessage;
 use function KseniaD2021\ticTacToe\View\getValue;

use const KseniaD2021\ticTacToe\Model\PLAYER_X;
use const KseniaD2021\ticTacToe\Model\PLAYER_O;

function key()
{
    $key = readline("Введите ключ: ");
    if ($key == "--new") {
        startGame();
    } elseif ($key == "--list") {
        showList();
    } elseif ($key == "--replayid") {
        showReplay();
    } else {
        echo "Не верный ключ.\n";
        key();
    }
}
function startGame()
{
    $continue = true;
    do {
        $GameBoard = new Board();
        initialize($GameBoard);
        gameLoop($GameBoard);
        inviteToContinue($continue);
    } while ($continue);
}

function initialize($board)
{
    try {
        $board->setSize(getValue("Введите размер поля"));
        $board->initialize();
    } catch (Exception $e) {
        showMessage($e->getMessage());
        initialize($board);
    }
}

function gameLoop($board)
{
    $stopTheGame = false;
    $currentMarkup = PLAYER_X;
    $messageOfEndGame = "";

    do {
        showGameBoard($board);
        if ($currentMarkup == $board->getMark()) {
            processUserTurn($board, $currentMarkup, $stopTheGame);
            $messageOfEndGame = "Игрок '$currentMarkup' выиграл!";
            $currentMarkup = $board->computerMark();
        } else {
            processComputerTurn($board, $currentMarkup, $stopTheGame);
            $messageOfEndGame = "Игрок '$currentMarkup' выиграл!";
            $currentMarkup = $board->getMark();
        }

        if (!$board->freeSpaceEnough() && !$stopTheGame) {
            showGameBoard($board);
            $messageOfEndGame = "Рисуйте!";
            $stopTheGame = true;
        }
    } while (!$stopTheGame);

    showGameBoard($board);
    showMessage($messageOfEndGame);
}

function processUserTurn($board, $mark, &$stopTheGame)
{
    $answerTaked = false;
    do {
        try {
            $coordinates = getCoordinates($board);
            $board->setMarkupOnBoard($coordinates[0], $coordinates[1], $mark);
            if ($board->determineWinner($coordinates[0], $coordinates[1]) !== "") {
                $stopTheGame = true;
            }

            $answerTaked = true;
        } catch (Exception $e) {
            showMessage($e->getMessage());
        }
    } while (!$answerTaked);
}

function getCoordinates($board)
{
    $mark = $board->getMark();
    $coordinates = getValue("Введите координаты Х и Y заполняемого поля для  '$mark' через '-'.");
    $coordinates = explode("-", $coordinates);
    $coordinates[0] = $coordinates[0] - 1;
    if (isset($coordinates[1])) {
        $coordinates[1] = $coordinates[1] -   1;
    } else {
        throw new Exception("Введите 2 координаты. Попробуйте еще раз.");
    }
    return $coordinates;
}

function processComputerTurn($board, $mark, &$stopTheGame)
{
    $answerTaked = false;
    do {
        $i = rand(0, $board->getDimension() - 1);
        $j = rand(0, $board->getDimension() - 1);
        try {
            $board->setMarkupOnBoard($i, $j, $mark);
            if ($board->determineWinner($i, $j) !== "") {
                $stopTheGame = true;
            }

            $answerTaked = true;
        } catch (Exception $e) {
        }
    } while (!$answerTaked);
}

function inviteToContinue(&$continue)
{
    $answer = "";
    do {
        $answer = getValue("Хотите сыграть еще раз? Введите у - да; n - нет.");
        if ($answer === "y") {
            $continue = true;
        } elseif ($answer === "n") {
            $continue = false;
        }
    } while ($answer !== "y" && $answer !== "n");
}
