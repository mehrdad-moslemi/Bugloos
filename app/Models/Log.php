<?php

namespace App\Models;

use App\Filters\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['service_name', 'date_time', 'method', 'path', 'protocol', 'status_code', 'created_at'];

    public function scopeFilter($query, $filters){
        return ( new FilterBuilder($query, $filters, 'App\Filters\LogFilters') )->apply();
    }
}
