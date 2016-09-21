<?php
declare(strict_types=1);

namespace TheGame\Domain;

use TheGame\Domain\Exception\GameOverException;
use TheGame\Domain\Exception\TooManyAttemptsException;

final class Game
{
    /**
     * @var Board
     */
    private $board;

    /**
     * @var bool
     */
    private $isRunning;

    /**
     * @var bool
     */
    private $isWon;

    /**
     * @var \DateTimeImmutable
     */
    private $startTime;

    public function __construct(Board $board, \DateTimeImmutable $startTime)
    {
        $this->board = $board;
        $this->isRunning = true;
        $this->startTime = $startTime;
    }

    public function makeMove(int $position, \DateTimeImmutable $time)
    {
        if (!$this->isRunning) {
            throw new GameOverException("Game is over");
        }
        
        try
        {
            $this->board->flipTokenAtPosition($position);
        }
        catch (TooManyAttemptsException $exception)
        {
            $this->isRunning = false;
        }

        if ($this->board->checkIfTokenIsWinning($position))
        {
            $this->isRunning = false;
            $this->isWon = true;
        }
    }

    public function stillPlaying() : bool {

        return $this->isRunning;
    }


}