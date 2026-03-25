<?php 

class Position {
    private int $row;
    private int $column;

    public function __construct(int $row, int $column) {
        $this->row = $row;
        $this->column = $column;
    }

    public function getRow(): int{
        return $this->row;
    }

    public function getColumn(): int{
        return $this->column;
    }

    public function equals(Position $other): bool{
        return ($this->getRow() === $other->getRow()) && ($this->getColumn() === $other->getColumn());
    }

    public function toKey(): string{
        return "$this->getColumn : "
    }
}