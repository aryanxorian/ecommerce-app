<?php

namespace EcommerceApp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use EcommerceApp\Models\User;

class Product extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
