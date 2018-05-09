<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $id
 * @property int $priority_id
 * @property int $status_id
 * @property int $person_id
 * @property string $settled
 * @property string $description
 * @property int $folios
 * @property int $days
 * @property Person $person
 * @property Priority $priority
 * @property Status $status
 * @property File[] $files
 * @property Notification[] $notifications
 * @property Thread[] $threads
 * @property TicketsAssignedUser $ticketsAssignedUser
 * @property Subject[] $subjects
 * @property Tracking[] $trackings
 * @property User[] $users
 */
class Ticket extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['person', 'priority', 'priority', 'status', 'files', 'notifications', 'threads', 'ticketsAssignedUser', 'subjects', 'trackings', 'users'];
    protected $dates = ['deleted_at'];
    /**
     * @var array
     */
    protected $fillable = ['priority_id', 'status_id', 'person_id', 'settled', 'description', 'folios', 'days'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo('App\Priority');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\File', 'tickets_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification', 'tickets_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany('App\Thread', 'tickets_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ticketsAssignedUser()
    {
        return $this->hasOne('App\TicketsAssignedUser', 'tickets_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'tickets_subject', 'tickets_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trackings()
    {
        return $this->hasMany('App\Tracking', 'tickets_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_involved_tickets', 'tickets_id', 'users_id');
    }
}
