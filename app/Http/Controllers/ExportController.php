<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\RoleUsersExport;
use App\Exports\EventsExport;
use App\Exports\EventApplicantsExport;
use App\Exports\PackagesExport;
use App\Exports\PackageApplicantsExport;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('monitor');
    }

    public function exportAllUsers()
    {
        return Excel::download(new UsersExport, 'all users.xlsx');
    }

    public function exportRoleUsers($role)
    {
        return Excel::download(new RoleUsersExport($role), "$role users.xlsx");
    }

    public function exportEvents()
    {
        return Excel::download(new EventsExport, 'all events.xlsx');
    }

    public function exportEventApplicants($id)
    {
        return Excel::download(new EventApplicantsExport($id), 'events applicants.xlsx');
    }

    public function exportPackages()
    {
        return Excel::download(new PackagesExport, 'all packages.xlsx');
    }

    public function exportPackageApplicants($id)
    {
        return Excel::download(new PackageApplicantsExport($id), 'packages applicants.xlsx');
    }
}
