<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Currency
 * @package App
 */
class Currency extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var string
     */
    protected $table = 'currency';
    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'rate',
        'date'
    ];

    /**
     * Scope with request parameters for currency filter
     *
     * @param $query
     * @param $filters
     */
    public function scopeFilter($query, $filters){
        if (isset($filters['name'])){
            $name = $filters['name'];
            $query->where('name', $name);
        }

        if(isset($filters['date'])){
            $date = date('Y-m-d',strtotime($filters['date']));
            $query->where('date', $date);
        }
    }
}
