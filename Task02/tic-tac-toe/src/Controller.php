<?php namespace KseniaD2021\ticTacToe\Controller;
    use function KseniaD2021\ticTacToe\View\showGame;
    
    function startGame() {
        echo "Game started".PHP_EOL;
        showGame();
    }
?>