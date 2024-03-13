<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['bill_id', 'file_path'];

    // Relationships
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
}
