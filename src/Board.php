<?php

class Board implements Renderable {
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
        // fait par IA (merci Tom !)
        $out = "\n    0  1  2  3  4  5  6  7\n";
        $out .= "  +------------------------+\n";

        for ($r = 0; $r <= 7; $r++) {
            $out .= $r . " |";
            for ($c = 0; $c <= 7; $c++) {
                $pos = new Position($r, $c);
                $p = $this->getPieceAt($pos);

                $isDark = ($r + $c) % 2 !== 0;
                $bg = $isDark ? "\e[48;5;240m" : "\e[48;5;245m";
                $reset = "\e[0m";

                $char = $p ? $p->render() : " ";

                $out .= $bg . " " . $char . " " . $reset;
            }
            $out .= "| " . $r . "\n";
        }

        $out .= "  +------------------------+\n";
        $out .= "    0  1  2  3  4  5  6  7\n";
        return $out;
    }

}