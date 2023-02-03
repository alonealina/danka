<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 

    protected $dates = ['created_at', 'updated_at'];
    
    protected $table = 'deal';

    public function outputCsvContent() {
        return [
            $this->deal_no,
            $this->name,            
            $this->name_kana,    
            $this->tel,         
            $this->total,       
            $this->payment_date,
            $this->created_at,
        ];
    }

}
