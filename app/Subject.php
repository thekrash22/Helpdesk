<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $id
 * @property int $area_id
 * @property string $name
 * @property boolean $isActive
 * @property Area $area
 * @property Ticket[] $tickets
 */
class Subject extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['area', 'tickets'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'subject';

    /**
     * @var array
     */
    protected $fillable = ['area_id', 'name', 'isActive'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tickets()
    {
        return $this->belongsToMany('App\Ticket', 'tickets_subject', null, 'tickets_id');
    }
}
