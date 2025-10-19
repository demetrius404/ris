<?php

namespace App\Http\Controllers;

use App\Models\Socks;
use App\Models\Operation;
use App\Models\Enums\OperationType as EnumOperationType;
use App\Models\Enums\Color as EnumColor;
use App\Functions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rules\ColorRussian;
use App\Rules\CottonPart;
use App\Rules\Quantity;


class Operations extends Controller {
    
    public function income(Request $request) {

        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'color' => ['required', new ColorRussian()],
            'cottonPart' => ['required', new CottonPart()],
            'quantity' => ['required', new Quantity()],
        ]);

        if ($validator->fails()) {
            return response()->json(
                (object) [], 
                400,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $data['color'] = EnumColor::fromRussian($data['color'])->toRussian();

        $socksList = Socks
          ::where(Functions::toColumnName('color'), '=', $data['color'])
          ->where(Functions::toColumnName('cottonPart'), '=', $data['cottonPart'])
          ->get();

        if (count($socksList) == 0) {
            
            $socks = Socks::from([
                'skuName' => 'Носки.' . ' Цвет: ' . $data['color'] . ',' . ' Хлопок: ' . $data['cottonPart'],
                'cottonPart' => $data['cottonPart'],
                'color' => $data['color']
            ]);
            $socks->save();
            $socksList = [$socks];

        };
        
        $operation = Operation::from([
            'operationType' => EnumOperationType::Income,
            'skuId' => $socksList[0]->skuId,
            'quantity' => $data['quantity']
        ]);

        $operation->save();
        
        $data = Functions::toCamelCaseArray($operation->toArray());
        $data['skuName'] = $socksList[0]->skuName;

        return response()->json(
            $data,
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function outcome(Request $request) {

        $data = $request->json()->all();

        $validator = Validator::make($data, [
            'color' => ['required', new ColorRussian()],
            'cottonPart' => ['required', new CottonPart()],
            'quantity' => ['required', new Quantity()],
        ]);

        if ($validator->fails()) {
            return response()->json(
                (object) [], 
                400,
                [],
                JSON_UNESCAPED_UNICODE
            );
        }

        $data['color'] = EnumColor::fromRussian($data['color'])->toRussian();

        $socksList = Socks
          ::where(Functions::toColumnName('color'), '=', $data['color'])
          ->where(Functions::toColumnName('cottonPart'), '=', $data['cottonPart'])
          ->get();

        if (count($socksList) == 0) {
            
            return response()->json(
                (object) [], 
                400,
                [],
                JSON_UNESCAPED_UNICODE
            );

        };

        $operation = Operation::from([
            'operationType' => EnumOperationType::Outcome,
            'skuId' => $socksList[0]->skuId,
            'quantity' => $data['quantity']
        ]);

        $incomeOperations = Operation
            ::where(Functions::toColumnName('skuId'), '=', $socksList[0]->skuId)
            ->where(Functions::toColumnName('operationType'), '=', EnumOperationType::Income)
            ->get();
        $incomeQuantity = $incomeOperations->sum('quantity');   

        $outcomeOperations = Operation
            ::where(Functions::toColumnName('skuId'), '=', $socksList[0]->skuId)
            ->where(Functions::toColumnName('operationType'), '=', EnumOperationType::Outcome)
            ->get();
        $outcomeQuantity = $outcomeOperations->sum('quantity');   

        $balanceQuantity = $incomeQuantity - $outcomeQuantity;
        
        if (($balanceQuantity - $operation->quantity) >= 0) {
            
            $operation->save();
            $data = Functions::toCamelCaseArray($operation->toArray());
            $data['skuName'] = $socksList[0]->skuName;

            return response()->json(
                $data,
                200,
                [],
                JSON_UNESCAPED_UNICODE
            );

        };

        return response()->json(
            (object) [], 
            400,
            [],
            JSON_UNESCAPED_UNICODE
        );

    }

}