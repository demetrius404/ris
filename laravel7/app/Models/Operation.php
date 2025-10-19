<?php

namespace App\Models;

use App\Functions;
use App\Rules\OperationType;
use App\Rules\Quantity;
use App\Models\Enums\OperationType as EnumOperationType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use function array_keys as arrayKeys;

class Operation extends Model {

    public function __construct(array $attributes = array()) {
        
        // Do not use __construct directly
        // Attributes expected in SnakeCase format

        parent::__construct($attributes);
        $this->operation_id = Functions::uuid();
    
    }

    public static function from(array $attributes = array()) {
        
        // Preferred method of creating an object
        // CamelCase to SnakeCase

        $attributesSnakeCase = array(); 
        $keys = arrayKeys($attributes);
        foreach ($keys as $key) {
            $attributesSnakeCase[Functions::toSnakeCase($key)] = $attributes[$key];
        }
        
        $attributesSnakeCase['operation_type'] = Functions::toLowerCase($attributesSnakeCase['operation_type']);
        
        $validator = Validator::make($attributesSnakeCase, [
            'operation_type' => ['required', new OperationType()],
            'sku_id' => ['required'],
            'quantity' => ['required', new Quantity()]
        ]);

        if ($validator->fails()) {
            return null;
        } else {
            $attributesSnakeCase['operation_type'] = EnumOperationType::fromEnglish($attributesSnakeCase['operation_type'])->value;
            return new Operation($attributesSnakeCase);
        };

    }

    public function getAttribute($key) {
        
        return parent::getAttribute(Str::snake($key));
    
    }

    public function setAttribute($key, $value) {

        return parent::setAttribute(Str::snake($key), $value);
    
    }

    // Model Settings
    protected $table = 'operations';
    protected $primaryKey = 'operation_id';
    protected $keyType = 'string'; // uuid as string
    public $timestamps = false;
    
    public $fillable = [
        'operation_type',
        'sku_id',
        'quantity'
    ];

}
