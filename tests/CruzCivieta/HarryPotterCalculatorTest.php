<?php


namespace CruzCivieta;


class HarryPotterCalculatorTest extends \PHPUnit_Framework_TestCase
{
    const FIRST_BOOK = 'first_book';
    const SECOND_BOOK = 'second_book';
    const THIRD_BOOK = 'third_book';
    const FOURTH_BOOK = 'fourth_book';
    const FIFTH_BOOK = 'fifth_book';

    /**
    * @test
    */
    public function buy_one_unit()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->anyBook());

        static::assertEquals($this->formatExpected('8.00'), $total);
    }

    /**
     * @test
     */
    public function buy_two_equals_unit()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->twoEqualBooks());

        static::assertEquals($this->formatExpected('16.00'), $total);
    }

    /**
    * @test
    */
    public function buy_n_equals_units()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->threeEqualBooks());

        static::assertEquals($this->formatExpected('24.00'), $total);
    }

    /**
    * @test
    */
    public function buy_two_different_books_then_do_five_percentage_discount()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->fourBookWithTwoDifferentBooks());

        static::assertEquals($this->formatExpected('15.20'), $total);
    }

    /**
     * @test
     */
    public function buy_three_different_books_do_ten_percentage_discount()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->threeDifferentBooks());

        static::assertEquals($this->formatExpected('21.60'), $total);
    }

    /**
     * @test
     */
    public function buy_three_books_where_two_are_different()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->threeBooksWithOneRepeated());

        static::assertEquals($this->formatExpected('23.20'), $total);
    }

    /**
    * @test
    */
    public function buy_four_books_where_all_are_different_do_twenty_percentage_discount()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->fourDifferentBooks());

        static::assertEquals($this->formatExpected('25.60'), $total);
    }

    /**
     * @test
     */
    public function buy_four_books_where_three_are_different()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->fourDifferentBooksWithOneRepeated());

        static::assertEquals($this->formatExpected('29.60'), $total);
    }

    /**
     * @test
     */
    public function buy_for_books_where_two_are_different()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->twoDifferentBooks());

        static::assertEquals($this->formatExpected('31.20'), $total);
    }

    /**
    * @test
    */
    public function buy_five_books_where_all_are_different_do_twenty_five_percentage_discount()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->theCollection());

        static::assertEquals($this->formatExpected('30'), $total);
    }

    /**
     * @test
     */
    public function buy_two_packs_of_two_different_books()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->pairOfDifferentBooks());

        static::assertEquals($this->formatExpected('30.40'), $total);
    }

    /**
     * @test
     */
    public function buy_kata_example()
    {
        $calculator = $this->createCalculator();

        $total = $calculator->calculate($this->anyCombinationOfBooks());

        static::assertEquals($this->formatExpected('51.60'), $total);
    }

    /**
     * @return array
     */
    private function anyBook()
    {
        return [static::FIRST_BOOK];
    }

    /**
     * @return array
     */
    private function twoEqualBooks()
    {
        return [static::FIRST_BOOK, static::FIRST_BOOK];
    }

    /**
     * @return array
     */
    private function threeEqualBooks()
    {
        return [static::FIRST_BOOK, static::FIRST_BOOK, static::FIRST_BOOK];
    }

    /**
     * @return array
     */
    private function fourBookWithTwoDifferentBooks()
    {
        return [static::FIRST_BOOK, static::SECOND_BOOK];
    }

    /**
     * @return array
     */
    private function threeDifferentBooks()
    {
        return [static::FIRST_BOOK, static::SECOND_BOOK, static::THIRD_BOOK];
    }

    /**
     * @return array
     */
    private function threeBooksWithOneRepeated()
    {
        return [static::FIRST_BOOK, static::SECOND_BOOK, static::FIRST_BOOK];
    }

    /**
     * @return array
     */
    private function fourDifferentBooks()
    {
        return [static::FIRST_BOOK, static::SECOND_BOOK, static::THIRD_BOOK, self::FOURTH_BOOK];
    }

    /**
     * @return array
     */
    private function fourDifferentBooksWithOneRepeated()
    {
        return [static::FIRST_BOOK, static::SECOND_BOOK, static::THIRD_BOOK, static::THIRD_BOOK];
    }

    /**
     * @return array
     */
    private function twoDifferentBooks()
    {
        return [static::FIRST_BOOK, static::THIRD_BOOK, static::THIRD_BOOK, static::THIRD_BOOK];
    }

    /**
     * @return array
     */
    private function theCollection()
    {
        return [
            static::FIRST_BOOK,
            static::SECOND_BOOK,
            static::THIRD_BOOK,
            self::FOURTH_BOOK,
            self::FIFTH_BOOK
        ];
    }

    /**
     * @return array
     */
    private function pairOfDifferentBooks()
    {
        return [static::FIRST_BOOK, static::FIRST_BOOK, static::SECOND_BOOK, static::SECOND_BOOK];
    }

    /**
     * @return array
     */
    private function anyCombinationOfBooks()
    {
        return [
            static::FIRST_BOOK,
            static::FIRST_BOOK,
            static::SECOND_BOOK,
            static::SECOND_BOOK,
            static::THIRD_BOOK,
            static::THIRD_BOOK,
            self::FOURTH_BOOK,
            self::FIFTH_BOOK
        ];
    }

    /**
     * @return HarryPotterCalculator
     */
    private function createCalculator()
    {
        return new HarryPotterCalculator(new HarryPotterCarManipulator());
    }

    /**
     * @param $amount
     * @return array
     */
    private function formatExpected($amount)
    {
        return [$amount, 'EUR'];
    }
}
