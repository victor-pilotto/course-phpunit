<?php

use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    protected $queue;

    public function setUp()
    {
        $this->queue = new Queue;
    }

    public function testNewQueueIsEmpty()
    {
        $this->assertEquals(0, $this->queue->getCount());
    }

    public function testAnItemIsAddedToTheQueue()
    {
        $this->queue->push('green');

        $this->assertEquals(1, $this->queue->getCount());
    }

    public function testAnItemIsRemovedFromTheQueue()
    {
        $this->queue->push('green');

        $item = $this->queue->pop();

        $this->assertEquals(0, $this->queue->getCount());

        $this->assertEquals('green', $item);
    }

    public function testAnItemIsRemovedFromTheFrontOfTheQueue()
    {
        $this->queue->push('first');
        $this->queue->push('second');

        $this->assertEquals('first', $this->queue->pop());
    }

    public function testMaxNumberOfItensCanBeAdded()
    {
        for ($i = 0; $i < Queue::MAX_ITENS; $i++) {
            $this->queue->push($i);
        }

        $this->assertEquals(Queue::MAX_ITENS, $this->queue->getCount());
    }

    public function testExceptionThrownWhenAddingAnItemToAFullQueue()
    {
        for ($i = 0; $i < Queue::MAX_ITENS; $i++) {
            $this->queue->push($i);
        }

        $this->expectException(QueueException::class);
        $this->expectExceptionMessage("Queue is full");

        $this->queue->push("FULL");
    }
}