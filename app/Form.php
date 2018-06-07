<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property int $area_id
 * @property int $thread_id
 * @property int $name_form_id
 * @property Area $area
 * @property NameForm $nameForm
 * @property Thread $thread
 * @property FormField[] $formFields
 */
class Form extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['area', 'nameForm', 'thread', 'formFields'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the extends Model.
     * 
     * @var string
     */
    protected $table = 'form';

    /**
     * @var array
     */
    protected $fillable = ['thread_id', 'name_form_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nameForm()
    {
        return $this->belongsTo('App\NameForm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formFields()
    {
        return $this->hasMany('App\FormField');
    }
}
