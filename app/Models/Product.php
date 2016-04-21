<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 4/21/2016
 * Time: 10:58 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = ['name', 'price'];

    public function values()
    {
        return $this->hasMany(Value::class);
    }

}