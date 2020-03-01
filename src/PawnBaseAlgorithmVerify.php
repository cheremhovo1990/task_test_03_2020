<?php

declare(strict_types=1);


abstract class PawnBaseAlgorithmVerify implements AlgorithmVerifiable
{
    /**
     * @var Pawn
     */
    protected $pawn;
    /**
     * @var Desk
     */
    protected $desk;


    protected $step = [
        'a' => ['b'],
        'b' => ['a', 'c'],
        'c' => ['b', 'd'],
        'd' => ['c', 'e'],
        'e' => ['d', 'f'],
        'f' => ['e', 'g'],
        'g' => ['f', 'h'],
        'h' => ['g']
    ];

    public function __construct(Pawn $pawn, Desk $desk)
    {
        $this->pawn = $pawn;
        $this->desk = $desk;
    }


    public function nextStep($xFrom, $yFrom, $xTo, $yTo)
    {
        if ($this->pawn->isFistStep()) {
            $this->first($xFrom, $yFrom, $xTo, $yTo);
        } else {
            $this->next($xFrom, $yFrom, $xTo, $yTo);
        }
    }

    abstract function first($xFrom, $yFrom, $xTo, $yTo);

    abstract function next($xFrom, $yFrom, $xTo, $yTo);

    public function verifyX($xFrom, $xTo, $yTo)
    {
        if ($xFrom != $xTo) {
            if (!in_array($xTo, $this->step[$xFrom])) {
                $this->desk->throwException('Не верный ход');
            }
            $this->beat($this->desk->getFigure($xTo, $yTo));
        }
    }

    public function beat(Figure $figure = null)
    {
        if (is_null($figure) || $this->pawn->equalIsBack($figure->getIsBlack())) {
            $this->desk->throwException('Не верный ход');
        }
    }
}