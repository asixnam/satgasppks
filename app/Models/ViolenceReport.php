<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class ViolenceReport extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'id_client',
        'id_reporter',
        'id_perpetrator',
        'id_violance'
    ];

    // Relasi belongsTo
    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    public function reporter()
    {
        return $this->belongsTo(Reporter::class, 'id_reporter');
    }

    public function perpetrator()
    {
        return $this->belongsTo(Perpetrator::class, 'id_perpetrator');
    }

    public function violance()
    {
        return $this->belongsTo(Violance::class, 'id_violance');
    }
}