<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bid
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string $message
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bid whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'status',
        'message',
        'comment'
    ];
}
