<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Umkm extends Model
{
    use HasFactory;



    protected $table = 'umkms';
    protected $guarded = [

    ];

    protected static function boot() {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
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
    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi', 'provinsi_id', 'id');
    }

    public function kota()
    {
        return $this->belongsTo('App\Models\Kota', 'kota_id', 'id');
    }
}
