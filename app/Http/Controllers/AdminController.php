<?php

namespace App\Http\Controllers;

use App\Models\Premise;
use App\Models\Reports;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAllReports()
    {
        $reports = Reports::with('user', 'premise', 'imagesProofs')->get();

        return view('admin.adminpanel', compact('reports'));
    }

    public function deletePremiseFromCatalog($premiseId, Request $request)
    {
        $reports = Reports::where('premise_id', $premiseId)->get();
        $premise = Premise::where('id', $premiseId)->first();
        $premise['deletedForReason'] = $request->get('reason');

        foreach ($reports as $report) {
            $report['statuses'] = 'Решено';
            $report->save();
        }

        $premise->save();
        return back()->with(['successDeleteFromCatalog' => 'Объявление скрыто из каталога']);
    }

    public function getBanUser($userId)
    {
        $user = User::where('id', $userId)->first();
        $user['is_blocked'] = 1;
        $user->save();
        $premisesOfOwner = Premise::where('user_id', $user['id'])->get();
        foreach ($premisesOfOwner as $premise) {
            $premise['bannedOwner'] = 1;
            $premise->save();
            $reports = Reports::where('premise_id', $premise['id'])->get();
            foreach ($reports as $report) {
                if($report['statuses'] === 'На рассмотрении'){
                    $report['statuses'] = 'Решено';
                    $report->save();
                }
            }
        }
        return back()->with(['successBanUser' => 'Вы заблокировали этого пользователя']);
    }

    public function changeStatusDenied($reportId)
    {
        $report = Reports::where('id', $reportId)->first();
        $report['statuses'] = 'Отклонена';
        $report->save();
        return back()->with(['successDenied' => 'Вы отклонили']);
    }

    public function getReviewsAll()
    {
        $reviews = Reviews::all();

        return view('admin.reviews', compact('reviews'));
    }

    public function deleteReview($reviewId)
    {
        Reviews::where('id', $reviewId)->delete();

        return back()->with(['seccessDelReview' => 'Вы успешно удалили отзыв']);
    }
}
