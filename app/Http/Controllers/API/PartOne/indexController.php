<?php

namespace App\Http\Controllers\API\PartOne;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function skipNumberFive(Request $request)
    {
        try {
            $input = $request->validate([
                'begin' => 'required|numeric|integer',
                'end' => 'required|numeric|integer',
            ]);
            if ($input['begin'] > $input['end']) {
                //swap
                $temp = $input['begin'];
                $input['begin'] = $input['end'];
                $input['end'] = $temp;
            }
            $result = 0;
            for ($idx = $input['begin']; $idx <= $input['end']; $idx++) {
                $num = strval($idx);
                if ($this->checkIfDigitsHaveFive($num))
                    continue;
                $result++;
            }
            return $this->sendResponse(['Result' => $result], 'Numbers retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    private function checkIfDigitsHaveFive($num)
    {
        while ($num) {
            if ($num % 10 === 5)
                return true;
            $num /= 10;
        }
        return false;
    }
    public function getIndexOfString(Request $request)
    {
        try {
            $input = $request->validate([
                'input_string' => 'required|string',
            ]);
            // considerations : all characters of string are lowercase
            $searchedString = $input['input_string'];
            // reverse string
            $searchedString = strrev($searchedString);
            $result = 0;
            for ($i = 0; $i < strlen($searchedString); $i++) {
                $result += ((ord($searchedString[$i]) - ord('A') + 1) * pow(26, $i));
            }
            return $this->sendResponse(['index_of_string' => $result], 'Result retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
    public function minimumStepsToZero(Request $request)
    {
        $input = $request->all();
        try {
            $arraySize = $input['N'];
            $arr = $input['Q'];
            $result = [];
            for ($idx = 0; $idx < $arraySize; $idx++) {
                // if return of getFirstDivisibleNum function is equal to -1 means this number is not a prime number
                $num = $arr[$idx];
                $steps = 0;
                while ($num != 0) {
                    $maxDivisible = $this->getMaxDivisibleNum($num);
                    if ($maxDivisible == -1) {
                        $num--;
                    } else {
                        $num = intval($maxDivisible);
                    }
                    $steps++;
                }
                $result[] = $steps;
            }
            return $this->sendResponse($result, 'Result retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    private function getMaxDivisibleNum($num)
    {
        if ($this->isPrime($num))
            return -1;
        $result = $num;
        for ($i = 2; $i * $i <= $num; $i++) {
            if ($num % $i === 0)
                $result = min($result, max($i, $num / $i));
        }
        return $result;
    }
    private function isPrime($num)
    {
        if ($num <= 3)
            return true;
        if ($num % 2 === 0)
            return false;
        for ($div = 2; $div * $div <= $num; $div++) {
            if ($num % $div === 0)
                return false;
        }
        return true;
    }
}
