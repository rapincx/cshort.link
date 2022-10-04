<?php

namespace App\Models;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 *
 * @property string $link
 * @property string $code
 * @property Date   $expired_date
 *
 * @package App\Models
 */
class Link extends Model
{
    use HasFactory;

    public $fillable = ['link', 'code', 'expired_date',];

    protected $casts = [
        'expired_date' => 'datetime:"d.m.Y, H:i"',
    ];

    /**
     * @return string
     * @author chaos
     */
    public function getRouteKeyName(): string
    {
        return 'code';
    }

    /**
     * @return string
     * @author chaos
     */
    public function getVisitLink(): string
    {
        return route('link-visit', $this);
    }
}
