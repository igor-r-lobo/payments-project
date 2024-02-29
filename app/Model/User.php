<?php declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $id
 * @property $document
 * @property $email
 * @property $name
 * @property $password
 * @property $account_type
 * @property $created_at
 * @property $updated_at
 */
class User extends Model
{
    /**
     * @var string
     */
    public string $keyType = 'string';

    /**
     * @var bool
     */
    public bool $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = ['id', 'document', 'email', 'name', 'password', 'account_type', 'created_at', 'updated_at'];
}
