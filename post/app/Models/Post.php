<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['user'];


    protected function user(): Attribute
    {
        if( ! $this->user_id )
            return Attribute::make(get: fn() => null);

        $url = config('microservice.user') . 'user/' . $this->user_id;

        $user = Http::get($url);

        return Attribute::make(
            get: fn() => $user['data'],
        );
    }
}
