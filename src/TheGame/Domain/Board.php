<?php
declare(strict_types=1);

namespace TheGame\Domain;

const TOKENS_QUANTITY = 40;
const MAX_FLIP_ATTEMPTS = 5;

use TheGame\Domain\Exception\TooManyAttemptsException;

final class Board
{
    private $tokens;
    private $flippedTokensCount;

    public function __construct(TokenFactory $tokenFactory)
    {
        $this->flippedTokensCount = 0;
        $this->tokens = $tokenFactory->createTokens(TOKENS_QUANTITY);
    }
    
    public function flipTokenAtPosition($position)
    {
        if ($this->flippedTokensCount >= 5) {
            throw new TooManyAttemptsException(sprintf("Maximal attempts count: %d reached", MAX_FLIP_ATTEMPTS));
        }

        $this->checkIfPositionExists($position);

        $this->tokens[$position]->flip();
        $this->flippedTokensCount++;
    }

    public function checkIfTokenIsWinning($position)
    {
        $this->checkIfPositionExists($position);
        return $this->tokens[$position]->isWinning();
    }

    private function checkIfPositionExists($position)
    {
        if (!array_key_exists($position, $this->tokens)) {
            throw new \Exception("Attempted to access token on a wrong position");
        }
    }
}