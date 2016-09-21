<?php

namespace spec\TheGame\Domain;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(false);
    }
    
    function it_can_be_flipped()
    {
        $this->flip();
        $this->isFlipped()->shouldReturn(true);
    }

    function it_is_not_flipped_by_default()
    {
        $this->isFlipped()->shouldReturn(false);
    }

    function it_can_not_be_flipped_more_than_once()
    {
        $this->flip();
        $this->shouldThrow(new \Exception("Token can be flipped only once"))->during("flip");
    }
    
    function it_can_be_constructed_as_winning()
    {
        $this->beConstructedWith(true);
        $this->isWinning()->shouldReturn(true);
    }
    
    function it_should_not_be_winning_by_default()
    {
        $this->isWinning()->shouldReturn(false);
    }
}
