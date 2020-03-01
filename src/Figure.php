<?php

class Figure {
    protected $isBlack;

    public function __construct($isBlack) {
        $this->isBlack = $isBlack;
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
