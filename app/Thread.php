<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

/**
 * @property int $id
 * @property int $tickets_id
 * @property int $users_id
 * @property string $reply
 * @property Ticket $ticket
 * @property User $user
 * @property File[] $files
 * @property Form[] $forms
 */
class Thread extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes =['user', 'tickets', 'files', 'forms'];
    protected $dates = ['deleted_at'];
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'thread';

    /**
     * @var array
     */
    protected $fillable = ['tickets_id', 'users_id', 'reply'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forms()
    {
        return $this->hasMany('App\Form');
    }
}
