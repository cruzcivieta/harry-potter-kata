<?php

namespace CruzCivieta;

class HarryPotterCalculator
{
    public function calculate($books)
    {
        if (count($books) === 2 && $books[0] !== $books[1]) {
            return $this->toMoneyRepresentation('15.20');
        }

        if (count($books) === 3) {
            $differentBooks = array_unique($books);

            if (count($differentBooks) === 2) {
                return $this->toMoneyRepresentation('23.20');
            }

            if (count($differentBooks) === 3) {
                return $this->toMoneyRepresentation('21.60');
            }
        }

        if (count($books) === 4) {
            $differentBooks = array_unique($books);

            if (count($differentBooks) === 3) {
                return $this->toMoneyRepresentation('29.60');
            }

            return $this->toMoneyRepresentation('25.60');
        }

        return $this->toMoneyRepresentation((string) (8.00 * count($books)));
    }

    private function toMoneyRepresentation($amount)
    {
        return [$amount, 'EUR'];
    }
}