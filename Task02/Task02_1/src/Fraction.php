<?php

namespace App;

class Fraction
{
    private int $numer;
    private int $denom;
    public function __construct(int $numer, int $denom)
    {
        if ($denom <= 0) {
            echo "Error! Invalid values!\n";
            exit();
        }

        $this -> reducethefraction($numer, $denom);
    }

    private function reducethefraction($numer, $denom)
    {
        $greatestCommonFactor = $this -> fractionn($numer, $denom);
        if ($greatestCommonFactor == 1) {
            $this -> numer = $numer;
            $this -> denom = $denom;
        } else {
            $this -> numer = $numer / $greatestCommonFactor;
            $this -> denom = $denom / $greatestCommonFactor;
        }
    }

    public function getNumer(): int
    {
        return $this -> numer;
    }

    public function getDenom(): int
    {
        return $this -> denom;
    }

    private function fractionn($a, $b): int
    {
        return ($a % $b) ? $this -> fractionn($b, $a % $b) : abs($b);
    }

    public function add(Fraction $frac): Fraction
    {
        $numer = $frac -> denom * $this -> numer + $this -> denom * $frac -> numer;
        $denom = $this -> denom * $frac -> denom;
        return new Fraction($numer, $denom);
    }

    public function sub(Fraction $frac): Fraction
    {
        $numer = $frac -> denom * $this -> numer - $this -> denom * $frac -> numer;
        $denom = $this -> denom * $frac -> denom;
        return new Fraction($numer, $denom);
    }

    private function convert(): string
    {
        $integerPart = intval($this -> numer / $this -> denom);
        $numer = abs($this -> numer % $this -> denom);
        return $integerPart . "'" . $numer . "/" . $this -> denom;
    }

    public function __toString(): string
    {
        if (abs($this -> numer) > $this -> denom) {
            return $this -> convert();
        }

        return $this -> numer . "/" . $this -> denom;
    }
}
