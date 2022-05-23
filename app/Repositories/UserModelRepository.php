<?php

namespace App\Repositories;

use App\Models\UserModel;
use App\Repositories\BaseRepository;

/**
 * Class UserModelRepository
 * @package App\Repositories
 * @version May 21, 2022, 9:47 pm UTC
*/

class UserModelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'UUID',
        'avatar_name',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'api_token',
        'last_login_at',
        'last_login_ip'
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
        return UserModel::class;
    }
}
