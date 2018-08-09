<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property string $name
 * @property Ticket[] $tickets
 */
class Status extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['tickets'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the extends Model.
     * 
     * @var string
     */
    protected $table = 'status';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
