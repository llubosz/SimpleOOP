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
        $this->beConstructedWith(new Board(new TestTokenFactory()), time());
    }

    function it_should_end_after_60_seconds()
    {
        $this->beConstructedWith(new Board(new TestTokenFactory()), 0);
        $this->shouldThrow()->during("makeMove", array(6));
    }

    function it_should_end_after_5_unsuccessful_moves()
    {
        for ($i=0; $i<=5; $i++) {
            $this->makeMove($i);
        }
    }

    function it_should_end_after_win()
    {
        $this->makeMove(6);
    }
}
