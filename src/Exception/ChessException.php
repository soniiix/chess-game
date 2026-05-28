<?php

namespace ChessGame\Exception;
use Exception;

class ChessException extends Exception {
    public function __construct(string $message) {
        parent::__construct($message);
    }
}