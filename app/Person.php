<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property int $dinType_id
 * @property string $dni
 * @property string $agentDni
 * @property string $agentName
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property DinType $dinType
 * @property Ticket[] $tickets
 */
class Person extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['dinType', 'tickets'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the extends Model.
     * 
     * @var string
     */
    protected $table = 'person';

    /**
     * @var array
     */
    protected $fillable = ['dinType_id', 'dni', 'name', 'agentDni', 'agentName', 'email', 'phone', 'address'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dinType()
    {
        return $this->belongsTo('App\DinType', 'dinType_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
