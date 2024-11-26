<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wtmdsaved extends Model
{
    use HasFactory;
    protected $table = 'wtmdsaveds';

    protected $fillable = [
        'operatorName',
        'testDateTime',
        'location',
        'deviceInfo',
        'certificateInfo',
        'resultPassIntest1',
        'resultPassOuttest1',
        'resultPassIntest2',
        'resultPassOuttest2',
        'resultPassIntest3',
        'resultPassOuttest3',
        'resultPassIntest4',
        'resultPassOuttest4',
        'result',
        'notes',
        'status',
        'submitted_by',
        'officerName',
        'supervisorName',
        'officer_signature',
        'supervisor_signature',
        'rejection_note',
        'reviewed_at',
        'reviewed_by',
        'supervisor_id'
    ];

    protected $casts = [
        'testDateTime' => 'datetime',
        'resultPassIntest1' => 'boolean',
        'resultPassIntest2' => 'boolean',
        'resultPassIntest3' => 'boolean',
        'resultPassIntest4' => 'boolean',
        'resultPassOuttest1' => 'boolean',
        'resultPassOuttest2' => 'boolean',
        'resultPassOuttest3' => 'boolean',
        'resultPassOuttest4' => 'boolean',
        'reviewed_at' => 'datetime'
    ];

    public function officer()
    {
        return $this->belongsTo(Officer::class, 'submitted_by');
    }
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
    public function isPending()
    {
        return $this->status === 'pending_supervisor';
    }
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
