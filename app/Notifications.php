<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $id
 * @property int $sender_users_id
 * @property int $tickets_id
 * @property int $received_users_id
 * @property int $area_sender_id
 * @property int $area_id
 * @property int $action_id
 * @property int $type_id
 * @property string $message
 * @property boolean $read
 * @property Action $action
 * @property Area $area
 * @property Area $area
 * @property User $user
 * @property User $user
 * @property Ticket $ticket
 * @property Type $type
 */
class Notifications extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['action', 'area', 'area_sender', 'user_received', 'user_sender', 'ticket', 'type'];
    protected $dates = ['deleted_at'];
    /**
     * @var array
     */
    protected $fillable = ['sender_users_id', 'tickets_id', 'received_users_id', 'area_sender_id', 'area_id', 'action_id', 'type_id', 'message', 'read'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function action()
    {
        return $this->belongsTo('App\Action');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area_sender()
    {
        return $this->belongsTo('App\Area', 'area_sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_received()
    {
        return $this->belongsTo('App\User', 'received_users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_sender()
    {
        return $this->belongsTo('App\User', 'sender_users_id');
    }

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
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
