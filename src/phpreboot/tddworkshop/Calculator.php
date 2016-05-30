<?php
namespace phpreboot\tddworkshop;

class Calculator
{
    /**
     * Get the sum of numbers
     */
    public function add($numbers = '')
    {
        if (empty($numbers)) {
            return 0;
        }
        
        if (!is_string($numbers)) {
            throw new \InvalidArgumentException('Parameters must be a string');
        }
        
        preg_split("/\n|,/", $numbers);
        $numbers = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n", "\\", ";"),",",$numbers);
        $numbers = stripslashes($numbers);
        $numbersArray = array_filter(explode(",", $numbers));
        
        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }
        
        return array_sum($numbersArray);
    }
}