<?php

class Queue
{
    public const MAX_ITENS = 5;

    protected $itens = [];

    public function push($item)
    {
        if ($this->getCount() == static::MAX_ITENS) {
            throw new QueueException("Queue is full");
        }

        $this->itens[] = $item;
    }

    public function pop()
    {
        return array_shift($this->itens);
    }

    public function getCount()
    {
        return count($this->itens);
    }
}