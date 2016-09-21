<?php

namespace spec\TheGame\Domain;

use TheGame\Domain\Board;
use TheGame\Domain\Exception\TooManyAttemptsException;
use TheGame\Domain\Game;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TheGame\Domain\TestTokenFactory;

class GameSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Board(new TestTokenFactory()), new \DateTimeImmutable());
    }

    function it_should_end_after_60_seconds()
    {
        $this->makeMove(7, new \DateTimeImmutable());
    }

    function it_should_end_after_5_unsuccessful_moves()
    {
        for ($i=0; $i<=5; $i++) {
            $this->makeMove($i, new \DateTimeImmutable());
        }
    }

    function it_should_end_after_win()
    {
        $this->makeMove(6, new \DateTimeImmutable());
    }
}
