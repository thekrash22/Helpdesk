<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JWTAuth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
/**
 * @property int $id
 * @property int $area_id
 * @property string $name
 * @property string $username
 * @property boolean $isActive
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $remember_token
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Area $area
 * @property Notification[] $notifications
 * @property Notification[] $notifications
 * @property Role[] $roles
 * @property Thread[] $threads
 * @property TicketsAssignedUser[] $ticketsAssignedUsers
 * @property TicketsAssignedUser[] $ticketsAssignedUsers
 * @property Tracking[] $trackings
 * @property Tracking[] $trackings
 * @property UsersInvolvedTicket[] $usersInvolvedTickets
 */
class Users extends Model implements AuditableContract
{
    /**
     * @var array
     */
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['area', 'notifications_received', 'usnotifications_senderer', 'roles', 'threads', 'ticketsAssignedUsersBy', 'ticketsAssignedUsersTo', 'trackings_target', 'trackings', 'usersInvolvedTickets'];
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['area_id', 'name', 'username', 'isActive', 'email', 'password', 'avatar', 'remember_token', 'deleted_at', 'created_at', 'updated_at'];
    
    protected $hidden = [ 'password', 'remember_token'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications_received()
    {
        return $this->hasMany('App\Notification', 'received_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications_sender()
    {
        return $this->hasMany('App\Notification', 'sender_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany('App\Thread', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketsAssignedUsersBy()
    {
        return $this->hasMany('App\TicketsAssignedUser', 'assigned_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketsAssignedUsersTo()
    {
        return $this->hasMany('App\TicketsAssignedUser', 'assigned_to_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trackings_target()
    {
        return $this->hasMany('App\Tracking', 'target_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trackings()
    {
        return $this->hasMany('App\Tracking', 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usersInvolvedTickets()
    {
        return $this->hasMany('App\UsersInvolvedTicket', 'users_id');
    }
    
   
}
