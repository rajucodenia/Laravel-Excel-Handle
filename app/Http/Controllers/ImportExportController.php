<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;
use App\Exports\UsersExport;

class ImportExportController extends Controller
{
    public function home() {
        $user_list = User::all();
        $context = [
            'user_list' => $user_list
        ];
        return view('welcome', $context);
    }

    public function import(Request $request){
        request()->validate([
            'file' => 'required|max:2048'
        ]);

        Excel::import(new UsersImport, 
        $request->file('file')->store('file'));
        return back()->with('massage', 'User Imported Successfully');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
