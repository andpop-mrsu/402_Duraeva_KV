<?php

namespace KseniaD2021\ticTacToe\View;

    use function cli\prompt;
    use function cli\line;
    use function cli\out;

function showGameBoard($board)
{
    $boardArr = $board->getBoardArr();
    $dimension = $board->getDimension();
    for ($i = 0; $i < $dimension; $i++) {
        for ($j = 0; $j < $dimension; $j++) {
            $tempVar = $boardArr[$i][$j];
            out("|$tempVar");
            if ($j === ($dimension - 1)) {
                out("|");
            }
        }
        line();
    }

    line("______________________________________
    ");
}
function showMessage($message)
{
    line($message);
}

function getValue($message)
{
    return prompt($message);
}

function showList()
{
    echo "Вывод списка всех сохраненных партий из БД SQLite3\n";
}

function showReplay()
{
    echo "Повстор игры с заданым id\n";
}
