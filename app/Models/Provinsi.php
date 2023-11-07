<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsis';
    protected $guarded = [

    ];

    protected static function boot() {

    }

     /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    public function kotas()
    {
        return $this->hasMany('App\Models\Kota', 'provinsi_id', 'id');
    }
}
