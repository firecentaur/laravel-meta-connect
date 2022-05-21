<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Question
 * @package App\Models
 * @version May 21, 2022, 7:23 pm UTC
 *
 * @property integer $parent
 * @property string $name
 * @property string $questiontext
 * @property boolean $questiontextformat
 * @property string $generalfeedback
 * @property boolean $generalfeedbackformat
 * @property number $defaultmark
 * @property number $penalty
 * @property string $qtype
 * @property integer $length
 * @property string $stamp
 * @property integer $createdby
 * @property integer $modifiedby
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
        'parent',
        'name',
        'questiontext',
        'questiontextformat',
        'generalfeedback',
        'generalfeedbackformat',
        'defaultmark',
        'penalty',
        'qtype',
        'length',
        'stamp',
        'createdby',
        'modifiedby'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent' => 'integer',
        'name' => 'string',
        'questiontext' => 'string',
        'questiontextformat' => 'boolean',
        'generalfeedback' => 'string',
        'generalfeedbackformat' => 'boolean',
        'defaultmark' => 'decimal:7',
        'penalty' => 'decimal:7',
        'qtype' => 'string',
        'length' => 'integer',
        'stamp' => 'string',
        'createdby' => 'integer',
        'modifiedby' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent' => 'required',
        'name' => 'required|string|max:255',
        'questiontext' => 'required|string',
        'questiontextformat' => 'required|boolean',
        'generalfeedback' => 'required|string',
        'generalfeedbackformat' => 'required|boolean',
        'defaultmark' => 'required|numeric',
        'penalty' => 'required|numeric',
        'qtype' => 'required|string|max:20',
        'length' => 'required',
        'stamp' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable',
        'createdby' => 'nullable',
        'modifiedby' => 'nullable'
    ];


}
