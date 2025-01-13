<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function createReview(Request $request)
    {
        $userId = Auth::id();
        $textReview = $request->input('textReview');
        Reviews::create([
           'user_id' => $userId,
           'textReview' => $textReview,
        ]);
        return back()->with(['successCreateReview' => 'Вы отправили отзыв']);
    }
}
