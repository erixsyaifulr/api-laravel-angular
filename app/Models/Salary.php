<?php
 
 namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Salary extends Model
{
    protected $fillable = ['nik', 'gaji'];
    protected $table = 'salary';
}