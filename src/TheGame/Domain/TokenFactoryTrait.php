<?php

namespace TheGame\Domain;

trait TokenFactoryTrait
{
    public function createTokens(int $quantity)
    {
        $winningTokenIndex = self::getRandomIndex($quantity);

        echo $winningTokenIndex;

        for ($i=0; $i<$quantity; $i++)
        {
            if ($i === $winningTokenIndex) {
                $tokens[] = new Token(true);
            }
            else {
                $tokens[] = new Token(false);
            }
        }

        return $tokens;
    }
}