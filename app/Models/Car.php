<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Car
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Car newModelQuery()
 * @method static Builder|Car newQuery()
 * @method static Builder|Car query()
 * @method static Builder|Car whereCreatedAt($value)
 * @method static Builder|Car whereId($value)
 * @method static Builder|Car whereName($value)
 * @method static Builder|Car whereUpdatedAt($value)
 * @method static Builder|Car whereUserId($value)
 * @mixin Eloquent
 */
class Car extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
