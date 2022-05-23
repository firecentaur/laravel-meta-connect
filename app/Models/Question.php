<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Question
 * @package App\Models
 * @version May 21, 2022, 8:03 pm UTC
 *
 * @property string $name
 * @property string $questiontext
 * @property boolean $questiontextformat
 * @property string $generalfeedback
 * @property boolean $generalfeedbackformat
 * @property number $defaultmark
 * @property number $penalty
 * @property string $qtype
 * @property integer $length
 * @property integer $created_by
 * @property integer $modified_by
 */
class Question extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'questions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'id',
        'name',
        'questiontext',
        'questiontextformat',
        'generalfeedback',
        'generalfeedbackformat',
        'defaultmark',
        'penalty',
        'qtype',
        'length',
        'created_by',
        'modified_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'questiontext' => 'string',
        'questiontextformat' => 'boolean',
        'generalfeedback' => 'string',
        'generalfeedbackformat' => 'boolean',
        'defaultmark' => 'decimal:7',
        'penalty' => 'decimal:7',
        'qtype' => 'string',
        'length' => 'integer',
        'created_by' => 'integer',
        'modified_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string|max:255',
        'questiontext' => 'required|string',
        'questiontextformat' => 'required|boolean',
        'generalfeedback' => 'required|string',
        'generalfeedbackformat' => 'required|boolean',
        'defaultmark' => 'required|numeric',
        'penalty' => 'required|numeric',
        'qtype' => 'required|string|max:20',
        'length' => 'required',
        'created_by' => 'nullable',
        'modified_by' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];


}
