<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'session';

    protected $guarded = [];

    /**
     * The name of the "created_at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created';

    /**
    * The name of the "updated_at" column.
    *
    * @var string
    */
   const UPDATED_AT = 'updated';

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'ID');
    }
}
