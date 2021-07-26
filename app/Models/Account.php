<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $type_account_id
 * @property string $name
 * @property float $value
 * @property int $state
 * @property string $created_at
 * @property string $updated_at
 * @property TypeAccount $typeAccount
 * @property User[] $users
 */
class Account extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['type_account_id', 'name', 'number_', 'value', 'type_', 'state', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeAccount()
    {
        return $this->belongsTo('App\TypeAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movements()
    {
        return $this->hasMany('App\Movement');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_has_account');
    }
}
