<?php

namespace TheGame\Domain;

use TheGame\Domain\TokenFactoryTrait;

class TestTokenFactory extends TokenFactory
{
    use TokenFactoryTrait;

    protected function getRandomIndex(int $maxOffset)
    {
        return 6;
    }
}