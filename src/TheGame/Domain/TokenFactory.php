<?php

namespace TheGame\Domain;


class TokenFactory implements TokenFactoryInterface
{
    use TokenFactoryTrait;

    protected function getRandomIndex(int $maxOffset)
    {
        return random_int(0, $maxOffset);
    }
}