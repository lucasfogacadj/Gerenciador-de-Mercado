<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Funcionarios
 * @package App\Models
 * @version June 29, 2018, 5:10 pm UTC
 */
class Funcionarios extends Model
{
    /*
    use SoftDeletes;

    public $table = 'funcionarios';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];
    */

    public $fillable = [
        'nome',
        'telefone',
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
        'telefone' => 'string',
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
