<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $subject_id
 * @property int $tickets_id
 * @property Subject $subject
 * @property Ticket $ticket
 */
class TicketSubject extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['subject', 'ticket'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tickets_subject';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'subject_id';

    /**
     * @var array
     */
    protected $fillable = ['tickets_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'tickets_id');
    }
}
