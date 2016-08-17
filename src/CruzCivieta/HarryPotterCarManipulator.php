<?php


namespace CruzCivieta;


class HarryPotterCarManipulator implements CarManipulator
{

    function extractDifferentBooks($books)
    {
        return array_unique($books);
    }

    function popDifferentBooks($books, $differentBooks)
    {
        foreach ($differentBooks as $book) {
            $pos = array_search($book, $books);
            if (false !== $pos) {
                unset($books[$pos]);
            }
        }

        return $books;
    }
}