<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $tickets_id
 * @property int $assigned_by_id
 * @property int $assigned_to_id
 * @property User $user
 * @property User $user
 * @property Ticket $ticket
 */
class TicketAssignedUser extends Model implements AuditableContract
{
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['user_assigend_by', 'user_assigend_to', 'ticket'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the extends Model.
     * 
     * @var string
     */
    protected $table = 'tickets_assigned_users';

    /**
     * The primary key for the extends Model.
     * 
     * @var string
     */

    /**
     * @var array
     */
    protected $fillable = ['assigned_by_id', 'assigned_to_id', 'tickets_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_assigend_by()
    {
        return $this->belongsTo('App\User', 'assigned_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_assigend_to()
    {
        return $this->belongsTo('App\User', 'assigned_to_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'tickets_id');
    }
}
