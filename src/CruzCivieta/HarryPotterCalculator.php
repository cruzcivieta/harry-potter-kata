<?php

namespace CruzCivieta;

class HarryPotterCalculator
{
    const DISCOUNTS = [
        1 => 0,
        2 => 0.95,
        3 => 0.90,
        4 => 0.80,
    ];


    const NORMAL_PRICE = 8.00;

    public function calculate($books)
    {
        $differentBooks = array_unique($books);
        if (count($differentBooks) > 1) {
            $total = $this->calculateWithDiscount($differentBooks);
            $total += $this->calculateRest($books, $differentBooks);

            return $this->toMoneyRepresentation((string) $total);
        }

        return $this->toMoneyRepresentation((string) $this->calculateBuyWithDifferentBooks($books));
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
        return round(static::NORMAL_PRICE * count($differentBooks) * $this->retrieveDiscount($differentBooks), 2);
    }

    /**
     * @param $books
     * @param $differentBooks
     * @return int
     */
    private function calculateRest($books, $differentBooks)
    {
        return static::NORMAL_PRICE * (count($books) - count($differentBooks));
    }

    /**
     * @param $books
     * @return float
     */
    private function calculateBuyWithDifferentBooks($books)
    {
        return static::NORMAL_PRICE * count($books);
    }

    /**
     * @param $differentBooks
     * @return mixed
     */
    private function retrieveDiscount($differentBooks)
    {
        return static::DISCOUNTS[count($differentBooks)];
    }
}