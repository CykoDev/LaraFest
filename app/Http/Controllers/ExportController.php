<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\AdminsExport;
use App\Exports\ApplicantsExport;
use App\Exports\ModeratorsExport;
use App\Exports\MonitorsExport;
use App\Exports\EventsExport;

class ExportController extends Controller
{
    public function exportAllUsers()
    {
        return Excel::download(new UsersExport, 'all users.xlsx');
    }

    public function exportApplicants()
    {
        return Excel::download(new ApplicantsExport, 'all applicants.xlsx');
    }

    public function exportAdmins()
    {
        return Excel::download(new AdminsExport, 'admin users.xlsx');
    }

    public function exportModerators()
    {
        return Excel::download(new ModeratorsExport, 'moderator users.xlsx');
    }

    public function exportMonitors()
    {
        return Excel::download(new MonitorsExport, 'monitor users.xlsx');
    }

    public function exportEvents()
    {
        return Excel::download(new EventsExport, 'all events.xlsx');
    }
}
