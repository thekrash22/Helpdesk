<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $users_id
 * @property int $tickets_id
 * @property Ticket $ticket
 * @property User $user
 */
class UsersInvolvedTicket extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['ticket', 'user'];
    protected $dates = ['deleted_at'];
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'users_id';

    /**
     * @var array
     */
    protected $fillable = ['tickets_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'tickets_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'users_id');
    }
}
