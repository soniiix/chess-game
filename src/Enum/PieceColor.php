<?php

enum PieceColor {
    case WHITE;
    case BLACK;

    public function opposite(): PieceColor{
        if ($this === PieceColor::WHITE) return PieceColor::BLACK;
        return PieceColor::WHITE;
    }
}