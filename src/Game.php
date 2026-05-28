<?php

namespace ChessGame;

use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Factory\PieceFactory;
use ChessGame\Exception\NoPieceException;
use ChessGame\Exception\WrongTurnException;
use ChessGame\Exception\InvalidMoveException;
use ChessGame\Exception\OccupiedByAllyException;

class Game {
    private Board $board;
    private PieceColor $currentPlayer;
    private PieceFactory $pieceFactory;

    public function __construct() {
        $this->board = new Board();
        $this->currentPlayer = PieceColor::WHITE;
        $this->pieceFactory = new PieceFactory();
    }

    public function start(): void {
        $this->setupPieces();
    }

    public function getBoard(): Board {
        return $this->board;
    }

    public function getCurrentPlayer(): PieceColor {
        return $this->currentPlayer;
    }

    public function play(Move $move): void {
        $piece = $this->board->getPieceAt($move->getFrom());

        if (!$piece) {
            throw new NoPieceException($move->getFrom());
        }

        if (!($piece->getColor() == $this->getCurrentPlayer())) {
            throw new WrongTurnException();
        }

        if (!$piece->canMove($this->board, $move->getTo())) {
            throw new InvalidMoveException();
        }

        $targetPiece = $this->board->getPieceAt($move->getTo());
        if ($targetPiece !== null && $piece->getColor() === $targetPiece->getColor()) {
            throw new OccupiedByAllyException();
        }

        $this->board->movePiece($move->getFrom(), $move->getTo());
        $this->switchPlayer();
    }

    public function isCheck(PieceColor $color): bool {
        $kingPosition = $this->board->getKingPosition($color);
        $pieces = $this->board->getPieces();
        foreach ($pieces as $piece) {
            if ($piece->getColor() !== $color && $piece->canMove($this->board, $kingPosition)) {
                return true;
            }
        }
        return false;
    }

    private function setupPieces(): void {
        // ligne 0 : tour, cavalier, fou, reine, roi, fou, cavalier, tour
        $this->board->placePiece($this->pieceFactory->create(PieceType::ROOK, PieceColor::BLACK, new Position(0, 0)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::KNIGHT, PieceColor::BLACK, new Position(0, 1)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::BISHOP, PieceColor::BLACK, new Position(0, 2)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::QUEEN, PieceColor::BLACK, new Position(0, 3)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::KING, PieceColor::BLACK, new Position(0, 4)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::BISHOP, PieceColor::BLACK, new Position(0, 5)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::KNIGHT, PieceColor::BLACK, new Position(0, 6)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::ROOK, PieceColor::BLACK, new Position(0, 7)));

        // ligne 1 : 8 pions
        for ($i = 0; $i < 8; $i++) {
            $this->board->placePiece($this->pieceFactory->create(PieceType::PAWN, PieceColor::BLACK, new Position(1, $i)));
        }

        // ligne 6 : 8 pions
        for ($i = 0; $i < 8; $i++) {
            $this->board->placePiece($this->pieceFactory->create(PieceType::PAWN, PieceColor::WHITE, new Position(6, $i)));
        }

        // ligne 7 : tour, cavalier, fou, reine, roi, fou, cavalier, tour
        $this->board->placePiece($this->pieceFactory->create(PieceType::ROOK, PieceColor::WHITE, new Position(7, 0)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::KNIGHT, PieceColor::WHITE, new Position(7, 1)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::BISHOP, PieceColor::WHITE, new Position(7, 2)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::QUEEN, PieceColor::WHITE, new Position(7, 3)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::KING, PieceColor::WHITE, new Position(7, 4)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::BISHOP, PieceColor::WHITE, new Position(7, 5)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::KNIGHT, PieceColor::WHITE, new Position(7, 6)));
        $this->board->placePiece($this->pieceFactory->create(PieceType::ROOK, PieceColor::WHITE, new Position(7, 7)));
    }

    private function switchPlayer(): void {
        $this->currentPlayer = $this->currentPlayer === PieceColor::WHITE ? PieceColor::BLACK : PieceColor::WHITE;
    }
}