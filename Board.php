<?php

class Board {
    private array $pieces = [];

    public function placePiece(Piece $piece): void{
       $this->pieces[$piece->getPosition()->toKey()] = $piece;
    }

    public function getPieceAt(Position $position): ?Piece{
        return $this->pieces[$position->toKey()];
    }

    public function hasPieceAt(Position $position): bool{
        return $this->pieces[$position->toKey()];
    }

    public function removePieceAt(Position $position): void{
        $this->pieces[$position->toKey()] = null;
    }

    public function movePiece(Position $from, Position $to): void {
        $piece = $this->getPieceAt($from);

        // déplacer la pièce
        $this->removePieceAt($from);
        $piece->setPosition($to);
        $this->placePiece($piece);
    }

    public function isPathClear(Position $from, Position $to): bool {
        $deltaX = $to->getRow() - $from->getRow();
        $deltaY = $to->getColumn() - $from->getColumn();

        $stepX = $deltaX === 0 ? 0 : ($deltaX > 0 ? 1 : -1);
        $stepY = $deltaY === 0 ? 0 : ($deltaY > 0 ? 1 : -1);

        $currentX = $from->getRow() + $stepX;
        $currentY = $from->getColumn() + $stepY;

        while ($currentX !== $to->getRow() || $currentY !== $to->getColumn()) {
            if ($this->hasPieceAt(new Position($currentX, $currentY))) {
                return false;
            }
            $currentX += $stepX;
            $currentY += $stepY;
        }
        return true;
    }

    public function getPieces(): array {
        return $this->pieces;
    }

    public function getKingPosition(PieceColor $color): ?Position{
        foreach ($this->pieces as $piece) {
            if ($piece->getType() === PieceType::KING && $piece->getColor() === $color) {
                return $piece->getPosition();
            }
        }
        return null;
    }

    public function render(): string {
        $boardStr = "";
        for ($row = 0; $row < 8; $row++) {
            for ($col = 0; $col < 8; $col++) {
                $piece = $this->getPieceAt(new Position($row, $col));
                if ($piece) {
                    $boardStr .= $piece->render() . " ";
                } else {
                    $boardStr .= ". ";
                }
            }
            $boardStr .= "\n";
        }
        return $boardStr;
    }

}