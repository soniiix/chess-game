<?php

class Queen extends Piece {
    protected PieceType $type = PieceType::QUEEN;

    protected function isValidMovementShape(Position $target): bool{
        // si la reine se déplace à l'horizontale
        if ($target->getRow() === $this->getPosition()->getRow()) {
            return true;
        }

        // si la reine se déplace à la verticale
        if ($target->getColumn() === $this->getPosition()->getColumn()) {
            return true;
        }

        // si la reine se déplace en diagonale
        $ecartX = abs($target->getRow() - $this->getPosition()->getRow());
        $ecartY = abs($target->getColumn() - $this->getPosition()->getColumn());
        return $ecartX === $ecartY;
    }
}