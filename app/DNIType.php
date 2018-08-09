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
 * @property Person[] $people
 */
class DNIType extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['people'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the extends Model.
     * 
     * @var string
     */
    protected $table = 'din_type';

    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function people()
    {
        return $this->hasMany('App\Person', 'dinType_id');
    }
}
