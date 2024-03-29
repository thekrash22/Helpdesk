<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property int $name_form_id
 * @property string $key
 * @property string $type
 * @property boolean $required
 * @property NameForm $nameForm
 * @property FormField[] $formFields
 */
class Field extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['nameForm', 'formFields'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the extends Model.
     * 
     * @var string
     */
    protected $table = 'field';

    /**
     * @var array
     */
    protected $fillable = ['name_form_id', 'field_key', 'field_values', 'type', 'required'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nameForm()
    {
        return $this->belongsTo('App\NameForm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formFields()
    {
        return $this->hasMany('App\FormField');
    }
}
