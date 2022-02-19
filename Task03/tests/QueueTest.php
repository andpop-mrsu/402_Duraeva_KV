<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Queue;

class QueueTest extends TestCase
{
    public function testEnqueueAndEmpty()
    {
        $queue = new Queue();
        $this -> assertSame(true, $queue -> isEmpty());
        $queue -> enqueue("15000", 1013);
        $this -> assertSame(false, $queue -> isEmpty());
    }

    public function testPeek()
    {
        $queue = new Queue(16, 6, "748", "7894", 32);
        $this -> assertSame(16, $queue -> peek());
    }

    public function testDequeue()
    {
        $queue1 = new Queue(4, 7, 9, 2, "54338", 45);
        $queue2 = new Queue();
        $this -> assertSame(4, $queue1 -> dequeue());
        $this -> assertSame(7, $queue1 -> peek());
        $this -> assertSame(null, $queue2 -> dequeue());
    }

    public function testTextRepresentation()
    {
        $queue = new Queue(5, 4, 3, 2, 1, "abra", 234124);
        $this -> assertSame("[5<-4<-3<-2<-1<-abra<-234124]", $queue -> __toString());
    }

    public function testCopy()
    {
        $queue = new Queue(3, 4, 42, 75, "673cgcgcg", 77);
        $newQueue = $queue -> copy();
        $this -> assertInstanceOf(Queue::class, $newQueue);
        $this -> assertSame(false, $newQueue -> isEmpty());
        $this -> assertSame(3, $newQueue -> peek());
    }
}