<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SlObject
 * @package App\Models
 * @version May 20, 2022, 3:52 am UTC
 *
 * @property string $UUID
 * @property string $owner
 * @property string $name
 * @property string $description
 * @property string $group
 * @property string $type
 * @property string $slurl
 * @property boolean $active
 */
class SlObject extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'slobjects';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'UUID',
        'userid',
        'owner',
        'name',
        'description',
        'group',
        'type',
        'slurl',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'userid' => 'integer',
        'UUID' => 'string',
        'owner' => 'string',
        'name' => 'string',
        'description' => 'string',
        'group' => 'string',
        'type' => 'string',
        'slurl' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'UUID' => 'nullable|string|max:255',
        'userid' => 'nullable|integer',
        'owner' => 'nullable|string|max:35',
        'name' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'group' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:25',
        'slurl' => 'nullable|string|max:255',
        'active' => 'nullable|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable|integer'
    ];


}
