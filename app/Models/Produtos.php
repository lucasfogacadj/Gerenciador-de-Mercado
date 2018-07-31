<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Produtos
 * @package App\Models
 * @version June 29, 2018, 5:00 pm UTC
 */
class Produtos extends Model
{
    /*
    use SoftDeletes;

    public $table = 'produtos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    */

    public $fillable = [
        'nome',
        'quantidade',
        'descricao'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'quantidade' => 'integer',
        'descricao' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
