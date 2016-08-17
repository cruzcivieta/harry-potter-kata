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
     * @param $books
     * @param $differentBooks
     * @return int
     */
    private function calculateRest($books, $differentBooks)
    {
        return static::NORMAL_PRICE * (count($books) - $this->numberOfBooks($differentBooks));
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
        if (!array_key_exists($this->numberOfBooks($differentBooks), static::DISCOUNTS)) {
            return 1;
        }

        return static::DISCOUNTS[$this->numberOfBooks($differentBooks)];
    }

    /**
     * @param $books
     * @return array
     */
    private function extractDifferentBooks($books)
    {
        return array_unique($books);
    }

    /**
     * @param $differentBooks
     * @return int
     */
    private function numberOfBooks($differentBooks)
    {
        return count($differentBooks);
    }

    private function popDifferentBooks($books, $differentBooks)
    {
        foreach ($differentBooks as $book) {
            $pos = array_search($book, $books);
            if (false !== $pos) {
                unset($books[$pos]);
            }
        }

        return $books;
    }

    private function doCalculate($books)
    {
        if ($this->numberOfBooks($books) === 0) {
            return 0;
        }

        $differentBooks = $this->extractDifferentBooks($books);
        $subtotal = $this->calculateWithDiscount($differentBooks);

        return $subtotal + $this->doCalculate($this->popDifferentBooks($books, $differentBooks));
    }
}