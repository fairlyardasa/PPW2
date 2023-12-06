<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';

    protected $fillable = ['judul', 'penulis', 'harga', 'tgl_terbit', 'filename', 'filepath'];

    protected $dates = ['tgl_terbit'];

    public function gallery(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany('App/Buku', 'id_buku', 'id');
    }

    public function rating(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        $totalRatings = $this->rating()->count();
        if ($totalRatings === 0) {
            return 0;
        }
        $sumRatings = $this->rating()->sum('rating');
        return $sumRatings / $totalRatings;
    }

    public function favorite(): HasMany
    {
        return $this->hasMany(User::class);
    }


}