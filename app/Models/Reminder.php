<?php

// app/Models/Reminder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['user_id', 'title', 'content', 'due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
