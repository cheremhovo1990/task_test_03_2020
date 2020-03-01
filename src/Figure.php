<?php

abstract class Figure {
    protected $isBlack;
    /**
     * @var Desk
     */
    private $desk;

    public function __construct($isBlack, Desk $desk) {
        $this->isBlack = $isBlack;
        $this->desk = $desk;
    }

    function verifyNextStep($xFrom, $yFrom, $xTo, $yTo)
    {
        // TODO: Implement verifyNextStep() method.
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString() {
        throw new \Exception("Not implemented");
    }

    /**
     * @return mixed
     */
    public function getIsBlack(): bool
    {
        return $this->isBlack;
    }

    public function equalIsBack(bool $bool): bool
    {
        return $this->isBlack === $bool;
    }
}
