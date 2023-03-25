<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'post_id'
    ];

    protected $appends = ['user'];


    protected function user(): Attribute
    {
        if (!$this->user_id)
            return Attribute::make(get: fn() => null);

        $url = config('microservice.user') . 'user/' . $this->user_id;

        $user = Http::withToken(request()->bearerToken())
            ->withHeaders(['Accept' => 'application/json'])
            ->get($url)
            ->json();

        return Attribute::make(
            get: fn() => $user['data'],
        );
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
