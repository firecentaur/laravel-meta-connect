<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Quiz
 * @package App\Models
 * @version May 21, 2022, 12:08 am UTC
 *
 * @property integer $userid
 * @property string $avatar_name
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
        'userid',
        'avatar_name',
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
        'userid' => 'integer',
        'avatar_name' => 'string',
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
        'userid' => 'required|integer',
        'avatar_name' => 'nullable|string|max:191',
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
