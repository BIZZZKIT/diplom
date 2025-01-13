<?php

namespace App\Http\Controllers;

use App\Models\ImagesProofs;
use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function createReport($premiseId, Request $request)
    {
        $validatedData = $request->validate([
            'reportText' => 'required|string|max:5000',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $report = Reports::create([
            'premise_id' => $premiseId,
            'userSend_id' => Auth::id(),
            'textOfReport' => $validatedData['reportText'],
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $image) {
                $fileName = time() . '-' . $image->getClientOriginalName();
                $path = $image->storeAs('proofs', $fileName, 'public');

                ImagesProofs::create([
                    'path' => $path,
                    'report_id' => $report->id,
                ]);
            }
        }

        return back()->with(['reportSend' => 'Ваша жалоба отправлена']);
    }


    public function getYoursReports()
    {
        $reports = Reports::where('userSend_id', Auth::id())->get();

        return view('users.myReports', compact('reports'));
    }

}
