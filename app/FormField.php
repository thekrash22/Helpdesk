<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $id
 * @property int $form_id
 * @property int $field_id
 * @property string $data
 * @property Field $field
 * @property Form $form
 */
class FormField extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['field', 'form'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'form_field';

    /**
     * @var array
     */
    protected $fillable = ['form_id', 'field_id', 'data'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field()
    {
        return $this->belongsTo('App\Field');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo('App\Form');
    }
}
