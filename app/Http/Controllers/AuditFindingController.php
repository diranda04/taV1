<?php

namespace App\Http\Controllers;

use App\AuditFinding;
use App\DepartmentAudit;
use App\Department;
use Illuminate\Http\Request;
use PDF;

class AuditFindingController extends Controller
{
    public function index($id_audit){
        $audit_findings = AuditFinding::where('audit_id',$id_audit)->get();
        return view ('auditee.finding', compact('audit_findings','id_audit'));
    }

    public function detailFinding($id_audit){
        $audit_findings = AuditFinding::where('audit_id',$id_audit)->get();
        return view ('auditor.finding', compact('audit_findings','id_audit'));
    }

    public function printFinding($id_audit){
        $audit_findings = AuditFinding::where('audit_id',$id_audit)->get();
        $auditors = DepartmentAudit::join("auditors", "department_audits.auditor_id", "=","auditors.id_auditor")
        ->join("audits", "department_audits.audit_id", "=", "audits.id_audit")
        ->join("users", "auditors.id_auditor", "=", "users.id")
        ->join("departments", "audits.department_id","=", "departments.id_department")
        ->where('audit_id',$id_audit)->get();
        $auditees = Department::leftJoin('audits', 'audits.department_id', '=', 'departments.id_department')
        ->leftJoin('auditees', 'auditees.department_id', '=', 'departments.id_department')
        ->leftJoin("users", "auditees.user_id", "=", "users.id")
        ->where('id_audit',$id_audit)->first();
        

        view()->share('audit_findings',$audit_findings);
        $pdf = PDF::loadview('audit.temuan_print', compact('audit_findings', 'auditors', 'auditees'));
        return $pdf->stream();
    }

    public function store(Request $request, $id_audit){
        $audit_findings = new AuditFinding ([
            'audit_id' => $id_audit,
            'desc' => $request->input('desc'),
        ]);
        $audit_findings->save();
        \Session::flash('sukses','Temuan Audit berhasil ditambahkan');
        return redirect()->back();
    }

    public function destroy($id_audit_finding){
        $audit_findings = AuditFinding::find($id_audit_finding)->delete();
        \Session::flash('sukses','Temuan Audit berhasil dihapus');
        return redirect()->back();
    }
}
