<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Comm extends Model{
    public static $rules=[
      'subject' => 'required'
    ];
    protected $fillable =['subject'];
}