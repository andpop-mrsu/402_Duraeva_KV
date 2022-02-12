<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Fraction;

class FractionTest extends TestCase
{
    public function testReduction()
    {
        $p = new Fraction(40,160);
        $this -> assertSame(1, $p -> getNumer());
        $this -> assertSame(4, $p -> getDenom());
    }

    public function testTextRepresentation()
    {
        $p1 = new Fraction(40, 160);
        $p2 = new Fraction(156, 40);
        $this -> assertSame("1/4", $p1 -> __toString());
        $this -> assertSame("3'9/10", $p2 -> __toString());
    }

    public function testAdding()
    {
        $p1 = new Fraction(40, 160);
        $p2 = new Fraction(156, 40);
        $p3 = $p1 -> add($p2);
        $this -> assertEquals("4'3/20", $p3);
    }

    public function testSubtraction()
    {
        $p1 = new Fraction(40, 160);
        $p2 = new Fraction(430, 851);
        $p3 = $p1 -> sub($p2);
        $this -> assertEquals("-869/3404", $p3);
        $p4 = new Fraction(156, 40);
        $p5 = $p1 -> sub($p4);
        $this -> assertEquals("-3'13/20", $p5);
    }
}
