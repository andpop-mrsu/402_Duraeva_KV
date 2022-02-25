<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Stack;

class StackTest extends TestCase
{
    public function testPushAndEmpty()
    {
        $stack = new Stack();
        $this -> assertSame(true, $stack -> isEmpty());
        $stack -> push("15000", 1013);
        $this -> assertSame(false, $stack -> isEmpty());
    }

    public function testTop()
    {
        $stack = new Stack(16, 6, "748", "7894", 32);
        $this -> assertSame(32, $stack -> top());
    }

    public function testPop()
    {
        $stack1 = new Stack(4, 7, 9, 2, "54338", 45);
        $stack2 = new Stack();
        $this -> assertSame(45, $stack1 -> pop());
        $this -> assertSame("54338", $stack1 -> top());
        $this -> assertSame(null, $stack2 -> pop());
    }

    public function testTextRepresentation()
    {
        $stack = new Stack(5, 4, 3, 2, 1, "abra", 234124);
        $this -> assertSame("[234124->abra->1->2->3->4->5]", $stack -> __toString());
    }

    public function testCopy()
    {
        $stack = new Stack(3, 4, 42, 75, "673cgcgcg", 77);
        $newStack = $stack -> copy();
        $this -> assertInstanceOf(Stack::class, $newStack);
        $this -> assertSame(false, $newStack -> isEmpty());
        $this -> assertSame(77, $newStack -> top());
    }
}