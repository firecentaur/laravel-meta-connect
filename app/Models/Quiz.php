<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Quiz
 * @package App\Models
 * @version May 20, 2022, 10:43 pm UTC
 *
 * @property integer $course
 * @property string $name
 * @property string $intro
 * @property string|\Carbon\Carbon $timeopen
 * @property string|\Carbon\Carbon $timeclose
 * @property integer $timelimit
 * @property boolean $canredoquestions
 * @property integer $attempts
 * @property integer $questionsperpage
 * @property boolean $shuffleanswers
 * @property number $grade
 * @property string $password
 */
class Quiz extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'quiz';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'course',
        'name',
        'intro',
        'timeopen',
        'timeclose',
        'timelimit',
        'canredoquestions',
        'attempts',
        'questionsperpage',
        'shuffleanswers',
        'grade',
        'password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course' => 'integer',
        'name' => 'string',
        'intro' => 'string',
        'timeopen' => 'datetime',
        'timeclose' => 'datetime',
        'timelimit' => 'integer',
        'canredoquestions' => 'boolean',
        'attempts' => 'integer',
        'questionsperpage' => 'integer',
        'shuffleanswers' => 'boolean',
        'grade' => 'decimal:0',
        'password' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course' => 'nullable',
        'name' => 'nullable|string|max:255',
        'intro' => 'nullable|string',
        'timeopen' => 'nullable',
        'timeclose' => 'nullable',
        'timelimit' => 'nullable',
        'canredoquestions' => 'nullable|boolean',
        'attempts' => 'nullable|integer',
        'questionsperpage' => 'nullable',
        'shuffleanswers' => 'nullable|boolean',
        'grade' => 'nullable|numeric',
        'password' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
