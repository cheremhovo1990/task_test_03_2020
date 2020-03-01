<?php

class Pawn extends Figure {
    /**
     * @var AlgorithmVerifiable
     */
    protected $algorithmVerify;
    protected $isFistStep = true;
    public function __construct($isBlack, Desk $desk)
    {
        parent::__construct($isBlack, $desk);
        if ($isBlack) {
            $this->algorithmVerify = new PawnTopVerify($this, $desk);
        } else {
            $this->algorithmVerify = new PawnBottomVerify($this, $desk);
        }
    }

    public function __toString() {
        return $this->isBlack ? '♟' : '♙';
    }

    function verifyNextStep($xFrom, $yFrom, $xTo, $yTo)
    {
        $this->algorithmVerify->nextStep($xFrom, $yFrom, $xTo, $yTo);
        $this->isFistStep = false;
    }

    public function isFistStep(): bool
    {
        return $this->isFistStep;
    }
}
