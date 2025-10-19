<?php

namespace App\Models;

use App\Functions;
use App\Rules\CottonPart;
use App\Rules\NameRussian;
use App\Rules\ColorRussian;
use App\Models\Enums\Color as EnumColor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use function array_keys as arrayKeys;

class Socks extends Model {

    public function __construct(array $attributes = array()) {
        
        // Do not use __construct directly
        // Attributes expected in SnakeCase format

        parent::__construct($attributes);
        $this->sku_id = Functions::uuid();
    
    }

    public static function from(array $attributes = array()) {
        
        // Preferred method of creating an object
        // CamelCase to SnakeCase

        $attributesSnakeCase = array(); 
        $keys = arrayKeys($attributes);
        foreach ($keys as $key) {
            $attributesSnakeCase[Functions::toSnakeCase($key)] = $attributes[$key];
        }
        
        $validator = Validator::make($attributesSnakeCase, [
            'sku_name' => ['required', new NameRussian(100)],
            'color' => ['required', new ColorRussian()],
            'cotton_part' => ['required', new CottonPart()]
        ]);

        if ($validator->fails()) {
            return null;
        } else {
            $attributesSnakeCase['color'] = EnumColor::fromRussian($attributesSnakeCase['color'])->toRussian();
            return new Socks($attributesSnakeCase);
        };

    }

    public function getAttribute($key) {
        
        return parent::getAttribute(Str::snake($key));
    
    }

    public function setAttribute($key, $value) {

        return parent::setAttribute(Str::snake($key), $value);
    
    }

    // Model Settings
    protected $table = 'socks';
    public $timestamps = false;
    protected $primaryKey = 'sku_id';
    protected $keyType = 'string'; // uuid as string
    
    public $fillable = [
        'sku_name',
        'color',
        'cotton_part'
    ];

}
