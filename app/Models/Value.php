<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 4/21/2016
 * Time: 10:59 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $table = 'value';
    protected $fillable = ['price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}