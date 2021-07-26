<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $account_id
 * @property integer $bank_id
 * @property integer $type_movement_id
 * @property float $amount
 * @property string $date_
 * @property string $created_at
 * @property string $updated_at
 * @property Account $account
 * @property Bank $bank
 * @property TypeMovement $typeMovement
 */
class Movement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movements';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['account_id', 'bank_id', 'type_movement_id', 'amount', 'date_', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return BelongsTo
     */
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    /**
     * @return BelongsTo
     */
    public function typeMovement()
    {
        return $this->belongsTo(TypeMovement::class);
    }
}
