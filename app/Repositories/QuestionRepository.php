<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\BaseRepository;

/**
 * Class QuestionRepository
 * @package App\Repositories
 * @version May 21, 2022, 8:03 pm UTC
*/

class QuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Question::class;
    }
}
