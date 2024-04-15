<?php

namespace Main;

class Test
{
    static $count = 0;

    public function increase()
    {
        return $this->count++;
    }
}