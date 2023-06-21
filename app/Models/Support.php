<?php

namespace App\Models;

use App\Enums\SupportStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'content',
        'status',
    ];

    // protected $casts=[
    //     'status'=> SupportStatus::class,
    // ];


    // Mutations
    public function status(): Attribute
    {
        return Attribute::make(
            set: fn (SupportStatus $status) => $status->name
        );
    }
}
