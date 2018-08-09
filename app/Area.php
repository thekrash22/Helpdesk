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
 * @property boolean $isActive
 * @property Form[] $forms
 * @property Notification[] $notifications
 * @property Notification[] $notifications
 * @property Subject[] $subjects
 */
class Area extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['name_form', 'notifications', 'notifications_sender', 'subjects'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the extends Model.
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
        return $this->hasMany('App\Notifications');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications_sender()
    {
        return $this->hasMany('App\Notifications', 'area_sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function user()
    {
        return $this->hasMany('App\Users');
    }
    
}
