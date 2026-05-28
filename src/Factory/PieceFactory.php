<?php

namespace ChessGame\Factory;
use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Position;
use ChessGame\Piece\Piece;
use ChessGame\Piece\Bishop;
use ChessGame\Piece\King;
use ChessGame\Piece\Knight;
use ChessGame\Piece\Pawn;
use ChessGame\Piece\Queen;
use ChessGame\Piece\Rook;

class PieceFactory {
    public function create(PieceType $type, PieceColor $color, Position $position): Piece {
        return match ($type) {
            PieceType::KING => new King($color, $position),
            PieceType::QUEEN => new Queen($color, $position),
            PieceType::ROOK => new Rook($color, $position),
            PieceType::BISHOP => new Bishop($color, $position),
            PieceType::KNIGHT => new Knight($color, $position),
            PieceType::PAWN => new Pawn($color, $position)
        };
    }
}