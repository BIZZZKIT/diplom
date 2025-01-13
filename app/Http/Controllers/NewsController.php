<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function createNews(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|regex:/^[\p{Cyrillic}a-zA-Z\s\-]+$/u|max:255',
            'mainText' => 'required|string|regex:/^[\p{Cyrillic}a-zA-Z\s\-]+$/u',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('news_photos', 'public');
        }

        News::create([
            'title' => $validatedData['title'],
            'main_text' => $validatedData['mainText'],
            'imagePath' => $imagePath,
        ]);

        return back()->with(['successNewsCreate' => 'Успешно создана новость']);
    }

}
