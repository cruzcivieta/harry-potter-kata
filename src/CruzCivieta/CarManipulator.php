<?php


namespace CruzCivieta;


interface CarManipulator
{
    function extractDifferentBooks($books);
    function popDifferentBooks($books, $differentBooks);
}