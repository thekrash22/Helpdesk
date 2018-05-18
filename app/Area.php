<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property boolean $isActive
 * @property Form[] $forms
 * @property Notification[] $notifications
 * @property Notification[] $notifications
 * @property Subject[] $subjects
 */
class Area extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['forms', 'notifications', 'notifications_sender', 'subjects'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'area';

    /**
     * @var array
     */
    protected $fillable = ['name', 'isActive'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function name_form()
    {
        return $this->hasMany('App\NameForm');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications_sender()
    {
        return $this->hasMany('App\Notification', 'area_sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }
}
