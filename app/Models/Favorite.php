<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $table = "favorite";
    protected $fillable = ['id', 'buku_id', 'user_email'];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }

}