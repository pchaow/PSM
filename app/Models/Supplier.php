<?php
/**
 * Created by PhpStorm.
 * User: chaow
 * Date: 4/21/2016
 * Time: 10:57 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = ['name', 'address'];
}