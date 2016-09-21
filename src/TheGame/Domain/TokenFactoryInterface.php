<?php

namespace TheGame\Domain;


interface TokenFactoryInterface
{
    public function createTokens(int $quantity);
}