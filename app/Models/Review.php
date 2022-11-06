<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $primaryKey   = 'id_review';
    protected $guarded = ['id_review'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
