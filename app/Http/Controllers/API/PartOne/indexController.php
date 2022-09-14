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
            $result = [];
            for ($idx = $input['begin']; $idx <= $input['end']; $idx++) {
                if (intval($idx) == 5)
                    continue;
                $result[] = intval($idx);
            }
            return $this->sendResponse($result, 'Numbers retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
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
                $firstDivisible = $this->getFirstDivisibleNum($arr[$idx]);
                if ($firstDivisible == -1) {
                    $result[] = intval($arr[$idx]);
                } else {
                    $result[] = intval($firstDivisible + 1);
                }
            }
            return $this->sendResponse($result, 'Result retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    private function getFirstDivisibleNum($num)
    {
        if ($num < 3)
            return -1;
        for ($i = 2; $i * $i <= $num; $i++) {
            if ($num % $i === 0)
                return $i;
        }
        return -1;
    }
}
