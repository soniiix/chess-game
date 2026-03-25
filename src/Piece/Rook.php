<?php

class Rook extends Piece {
    protected PieceType $type = PieceType::ROOK;

    protected function isValidMovementShape(Position $target): bool{
        // déplacement horizontal
        if ($target->getRow() === $this->getPosition()->getRow()) {
            return true;
        }

        // déplacement vertical
        if ($target->getColumn() === $this->getPosition()->getColumn()) {
            return true;
        }

        return false;
    }
}