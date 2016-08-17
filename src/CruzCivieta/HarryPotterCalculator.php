<?php

namespace CruzCivieta;

class HarryPotterCalculator
{
    const DISCOUNTS = [
        2 => 0.95,
        3 => 0.90,
        4 => 0.80,
        5 => 0.75,
    ];

    const NORMAL_PRICE = 8.00;

    /**
     * @var CarManipulator
     */
    protected $manipulator;

    /**
     * HarryPotterCalculator constructor.
     * @param CarManipulator $manipulator
     */
    public function __construct(CarManipulator $manipulator)
    {
        $this->manipulator = $manipulator;
    }

    public function calculate($books)
    {
        $total = $this->doCalculate($books);

        return $this->toMoneyRepresentation((string) $total);
    }

    private function toMoneyRepresentation($amount)
    {
        return [$amount, 'EUR'];
    }

    /**
     * @param $differentBooks
     * @return float
     */
    private function calculateWithDiscount($differentBooks)
    {
        return round(static::NORMAL_PRICE * $this->numberOfBooks($differentBooks) * $this->retrieveDiscount($differentBooks), 2);
    }

    /**
     * @param $differentBooks
     * @return mixed
     */
    private function retrieveDiscount($differentBooks)
    {
        if (!array_key_exists($this->numberOfBooks($differentBooks), static::DISCOUNTS)) {
            return 1;
        }

        return static::DISCOUNTS[$this->numberOfBooks($differentBooks)];
    }

    /**
     * @param $differentBooks
     * @return int
     */
    private function numberOfBooks($differentBooks)
    {
        return count($differentBooks);
    }

    private function doCalculate($books)
    {
        if ($this->numberOfBooks($books) === 0) {
            return 0;
        }

        $differentBooks = $this->manipulator->extractDifferentBooks($books);
        $subtotal = $this->calculateWithDiscount($differentBooks);

        return $subtotal + $this->doCalculate($this->manipulator->popDifferentBooks($books, $differentBooks));
    }
}