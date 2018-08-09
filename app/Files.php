<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property int $id
 * @property int $tickets_id
 * @property int $thread_id
 * @property string $url
 * @property string $name
 * @property Thread $thread
 * @property Ticket $ticket
 */
class Files extends Model implements AuditableContract
{   
    use SoftDeletes, CascadeSoftDeletes, Auditable;
    protected $cascadeDeletes =['thread', 'ticket'];
    protected $dates = ['deleted_at'];
    /**
     * @var array
     */
    protected $fillable = ['tickets_id', 'thread_id', 'url', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'tickets_id');
    }
}
