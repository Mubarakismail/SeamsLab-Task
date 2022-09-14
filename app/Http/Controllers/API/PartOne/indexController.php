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
}
