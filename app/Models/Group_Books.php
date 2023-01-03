<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Group_Books extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    public function GroupBook(){
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function Group(){
        return $this->belongsTo(Group::class, 'group_id');
    }
}
