<?php 

class Position {
    private int $row;
    private int $column;

    public function __construct(int $row, int $column) {
        if (($row < 0 || $row > 7) || ($column < 0 || $column > 7)) {
            throw new InvalidArgumentException("row et column doivent être compris entre 0 et 7");        
        }
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
        return "{$this->getColumn()}:{$this->getRow()}";
    }

    public static function fromKey(string $key): Position {
        $column = explode(":", $key)[0];
        $row = explode(":", $key)[1];

        return new Position($row, $column);
    }
}