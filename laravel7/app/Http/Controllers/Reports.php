<?php

namespace App\Http\Controllers;

use App\Functions;
use App\Rules\ColorEnglish;
use App\Rules\CottonPart;
use App\Models\Enums\Color as EnumColor;
use App\Models\Enums\OperationType as EnumOperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB as Database;

// TODO: move to Functions
use function array_push as pushToArray;

// Enum for 'operation' (English) and 'cottonPart' parameters
class CottonPartOperations {

    public const MoreThan = 'moreThan';
    public const LessThan = 'lessThan';
    public const Equal = 'equal';

}

class Reports extends Controller {
    
    public function balance(Request $request) {

        $data = [
            'color' => $request->query('color', null),
            'operation' => $request->query('operation', null),
            'cottonPart' => $request->query('cottonPart', null),
        ];

        // Validate 'color' (English) parameter
        if (!Functions::isNull($data['color'])) {
            $validator = Validator::make($data, [
                'color' => ['required', new ColorEnglish()],
            ]);
            if ($validator->fails()) {
                return response()->json((object) [], 400);
            };

            $data['color'] = EnumColor::fromEnglish($data['color'])->toRussian();

        };

        // Validate 'operation' (English) and cottonPart' parameters
        if (!Functions::isNull($data['operation']) || !Functions::isNull($data['cottonPart'])) {

            $data['cottonPart'] = Functions::toInteger($data['cottonPart']);
            $values = [
                CottonPartOperations::MoreThan,
                CottonPartOperations::LessThan,
                CottonPartOperations::Equal,
            ];
            $validator = Validator::make($data, [
                'cottonPart' => ['required', new CottonPart()],
                'operation' => ['required', Rule::in($values, 'value')],
            ]);

            if ($validator->fails()) {
                return response()->json((object) [], 400);
            };

        }

        $q = chr(34);
        $where = ';';
        $whereColor= null;
        $whereCottonPart = null;
        $bindings = [
            'incomeOperationType' => EnumOperationType::Income,
            'outcomeOperationType' => EnumOperationType::Outcome,
        ];

        if (!Functions::isNull($data['color'])) {
            $whereColor = "{$q}socks{$q}.{$q}color{$q} = :color";
            $bindings['color'] = $data['color'];
        }

        if (!Functions::isNull($data['operation']) && !Functions::isNull($data['cottonPart'])) {
            
            $operation = null;
            switch ($data['operation']) {  
                case CottonPartOperations::MoreThan: $operation = '>'; break;  
                case CottonPartOperations::LessThan: $operation = '<'; break;
                case CottonPartOperations::Equal: $operation = '='; break;
            }
            $whereCottonPart = "{$q}socks{$q}.{$q}cotton_part{$q} {$operation} :cottonPart";
            $bindings['cottonPart'] = $data['cottonPart'];
    }

    if (!Functions::isNull($whereColor)) {
        $where = "WHERE $whereColor;";
    }

    if (!Functions::isNull($whereCottonPart)) {
        $where = "WHERE $whereCottonPart;";
    }

    if (!Functions::isNull($whereColor) && !Functions::isNull($whereCottonPart)) {
        $where = "WHERE $whereColor AND $whereCottonPart;";
    }
   

    $query = (string) '
        WITH "cte_operations" AS (
            SELECT 
                "sku_id",
                SUM(CASE WHEN "operation_type" = :incomeOperationType THEN "quantity" ELSE 0 END) AS "income",
                SUM(CASE WHEN "operation_type" = :outcomeOperationType THEN "quantity" ELSE 0 END) AS "outcome"
            FROM "operations" GROUP BY "sku_id"
        )
        SELECT
            "cte_operations"."sku_id" AS "sku_id",
            "socks"."sku_name" AS "sku_name", 
            "socks"."color" AS "color",
            "socks"."cotton_part" AS "cotton_part",
            "cte_operations"."income" - "cte_operations"."outcome" as "quantity"
        FROM "cte_operations"
        LEFT JOIN "socks" ON "socks"."sku_id" = "cte_operations"."sku_id"
        ' . $where;

        $records = Database::select($query, $bindings);

        if(count($records) == 0) return response()->json([(object) []], 200); // [{}]

        // TODO: move to Functions
        $result = [];
        foreach ($records as $record) {
            pushToArray($result, Functions::toCamelCaseArray($record));
        };

        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);

    }

}