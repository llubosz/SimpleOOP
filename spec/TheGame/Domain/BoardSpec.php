<?php

namespace spec\TheGame\Domain;

use PhpSpec\Exception\Example\NotEqualException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TheGame\Domain\TestTokenFactory;
use TheGame\Domain\Token;
use TheGame\Domain\Exception\TooManyAttemptsException;

class BoardSpec extends ObjectBehavior
{
    /**
     * @var array
     */
    private $tokens;

    function let()
    {
        $this->beConstructedWith(new TestTokenFactory());
        $reflection = new \ReflectionProperty('TheGame\Domain\Board', 'tokens');
        $reflection->setAccessible(true);
        $this->tokens = $reflection->getValue($this->getWrappedObject());
    }

    function it_should_have_40_unflipped_tokens_by_default()
    {
        $tokenCount = count($this->tokens);

        if ($tokenCount !== 40) {
            throw new NotEqualException("Tokens count not equal", 40, $tokenCount);
        }
    }

    function it_should_have_only_one_winning_token()
    {
        $winningTokenCount = count(array_filter($this->tokens, function (Token $token) {
            return $token->isWinning();
        }));

        if ($winningTokenCount !== 1) {
            throw new NotEqualException("Winning tokens count not equal", 1, $winningTokenCount);
        }
    }

    function it_should_allow_to_flip_only_5_tokens()
    {
        for ($i=0; $i<5; $i++)
        {
            $this->flipTokenAtPosition($i);
        }
        $this->shouldThrow(new TooManyAttemptsException("Maximal attempts count: 5 reached"))->during("flipTokenAtPosition", [5]);
    }

    function it_dont_allow_to_access_token_on_wrong_position()
    {
        $this->shouldThrow(new \Exception("Attempted to access token on a wrong position"))->during("flipTokenAtPosition", [-1]);
        $this->shouldThrow(new \Exception("Attempted to access token on a wrong position"))->during("checkIfTokenIsWinning", [41]);
        $this->shouldThrow(new \Exception("Attempted to access token on a wrong position"))->during("flipTokenAtPosition", [-1]);
        $this->shouldThrow(new \Exception("Attempted to access token on a wrong position"))->during("checkIfTokenIsWinning", [41]);

    }

    function it_should_allow_to_check_winning_status_of_token_at_position()
    {
        $this->checkIfTokenIsWinning(6)->shouldBe(true);
    }
}
