<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordContact extends Model {

    protected $table = 'record_contact';
    protected $fillable = ['user_id', 'original_entry', 'contact', 'comment', 'status', 'calculation_type'];

    public function record()
    {
        return $this->hasMany(Record::class);
    }

}