<?php
declare(strict_types=1);

namespace TheGame\Domain;

final class Token
{
    /**
     * @var $isWinning;
     */
    private $isWinning;

    /**
     * @var $isFlipped
     */
    private $isFlipped;

    public function __construct(bool $winning)
    {
        $this->isWinning = $winning;
        $this->isFlipped = false;
    }

    public function flip()
    {
        if ($this->isFlipped()) {
            throw new \Exception("Token can be flipped only once");
        }
        $this->isFlipped = true;
    }

    public function isWinning() : bool
    {
        return $this->isWinning;
    }

    public function isFlipped() : bool
    {
        return $this->isFlipped;
    }
}