<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedSkin extends Model
{
    use HasFactory;
    protected $table = 'purchased_skins';

    protected $fillable = ['user_id', 'skin_id', 'color'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function skin()
    {
        return $this->belongsTo(Skin::class, 'skin_id');
    }
}
