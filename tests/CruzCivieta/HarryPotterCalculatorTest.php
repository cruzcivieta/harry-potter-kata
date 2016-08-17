<?php


namespace CruzCivieta;


class HarryPotterCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
    * @test
    */
    public function buy_one_unit()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book']);

        static::assertEquals(["8.00", "EUR"], $total);
    }

    /**
     * @test
     */
    public function buy_two_equals_unit()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book', 'first_book']);

        static::assertEquals(["16.00", "EUR"], $total);
    }

    /**
    * @test
    */
    public function buy_n_equals_units()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book', 'first_book', 'first_book']);

        static::assertEquals(["24.00", "EUR"], $total);
    }

    /**
    * @test
    */
    public function buy_two_different_books_then_do_five_percentage_discount()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book', 'second_book']);

        static::assertEquals(["15.20", "EUR"], $total);
    }

    /**
     * @test
     */
    public function buy_three_different_books_do_ten_percentage_discount()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book', 'second_book', 'third_book']);

        static::assertEquals(["21.60", "EUR"], $total);
    }

    /**
     * @test
     */
    public function buy_three_books_where_two_are_different()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book', 'second_book', 'first_book']);

        static::assertEquals(["23.20", "EUR"], $total);
    }

    /**
    * @test
    */
    public function buy_for_books_where_all_are_different_do_twenty_percentage_discount()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book', 'second_book', 'third_book', 'forth_book']);

        static::assertEquals(["25.60", "EUR"], $total);
    }

    /**
     * @test
     */
    public function buy_for_books_where_all_are_three_are_different()
    {
        $calculator = new HarryPotterCalculator();

        $total = $calculator->calculate(['first_book', 'second_book', 'third_book', 'third_book']);

        static::assertEquals(["29.60", "EUR"], $total);
    }

}
