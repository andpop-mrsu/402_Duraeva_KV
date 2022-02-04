<?php

namespace App\Test;

use App\Fraction;

function runTest()
{
    $m1 = new Fraction(40, 160);
    echo $m1 . "\n"; // 1/4
    echo $m1 -> getNumer() . " :числитель\n"; // 1
    echo $m1 -> getDenom() . " :знаменатель\n"; // 4

    $m2 = new Fraction(156, 40);
    echo $m2 . "\n"; // 3'9/10

    $m3 = $m1 -> add($m2);
    echo $m3 . "\n"; // 4'3/20

    $m4 = new Fraction(430, 851);
    $m5 = $m1 -> sub($m4);
    echo $m5 . "\n"; // -869/3404

    $m6 = new Fraction(453, 234);
    echo $m6 . "\n"; // 1'73/78

    $m7 = $m1 -> sub($m2);
    echo $m7 . "\n"; // -3'13/20
}
