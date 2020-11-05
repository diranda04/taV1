<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = ['id_audit','periode_id','department_id'];
    protected $primaryKey = 'id_audit';
    public $incrementing = false;

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id','id_periode');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id','id_department');
    }

    public function departmentAudit(){
        return $this->hasMany(DepartmentAudit::class, 'audit_id', 'id_audit');
    }

    public function auditScore(){
        return $this->hasMany(AuditScore::class);
    }

    public function auditFinding(){
        return $this->hasMany(AuditFinding::class);
    }

    public function correctionForm(){
        return $this->hasMany(CorrectionForm::class);
    }

    // public function auditor(){
    //     return $this->belongsToMany(Auditor::class, 'department_audits', 'audit_id', 'auditor_id');
    // }


}
