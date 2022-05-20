<?php

namespace App\Repositories;

use App\Models\SlObject;
use App\Repositories\BaseRepository;

/**
 * Class SlObjectRepository
 * @package App\Repositories
 * @version May 20, 2022, 3:52 am UTC
*/

class SlObjectRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'UUID',
        'owner',
        'name',
        'description',
        'group',
        'type',
        'slurl',
        'active'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SlObject::class;
    }
}
