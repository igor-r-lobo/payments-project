<?php declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 * @property $balance
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 */
class Balance extends Model
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
     * @var string
     */
    protected ?string $table = "balance";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected array $fillable = ['balance', 'user_id', 'created_at', 'updated_at'];
}
