<?php

abstract class Piece implements Renderable {
    protected PieceColor $color;
    protected Position $position;
    protected PieceType $type;

    public function __construct(PieceColor $color, Position $position){
        $this->color = $color;
        $this->position = $position;
    }

    public function getColor(): PieceColor{
        return $this->color;
    }

    public function getPosition(): Position{
        return $this->position;
    }

    public function setPosition(Position $position): void{
        $this->position = $position;
    }

    public function getType(): PieceType{
        return $this->type;
    }

    public function render(): string{
        $str = match ($this->getType()) {
            PieceType::KING => "K",
            PieceType::QUEEN => "Q",
            PieceType::ROOK => "R",
            PieceType::BISHOP => "B",
            PieceType::KNIGHT => "N",
            PieceType::PAWN => "P",
        };

        if ($this->getColor() === PieceColor::BLACK) {
            return strtolower($str);
        }

        return $str;
    }

    public function canMove(Board $board, Position $target): bool{
        if ($target->equals($this->getPosition())) {
            return false;
        }

        if (!$this->isValidMovementShape($target)) {
            return false;
        }

        if ($board->hasPieceAt($target)) {
            $pieceAtTarget = $board->getPieceAt($target);
            if ($pieceAtTarget->getColor() === $this->getColor()) {
                return false;
            }
        }

        // si la pièce n'est pas un cavalier, le chemin est libre ;
        if ($this->getType() !== PieceType::KNIGHT) {
            if (!$board->isPathClear($this->getPosition(), $target)) {
                return false;
            }
        }

        return true;
    }

    abstract protected function isValidMovementShape(Position $target): bool;

    protected function canCapture(Board $board, Position $target): bool{
        return false;
    }
}