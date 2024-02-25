<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ideas = Idea::orderBy('created_at', 'DESC');

        if (request()->has('search')) {
            $ideas = Idea::where('content', 'like', '%' . request('search') . '%')->orderBy('created_at', 'DESC');
        }

        return view('dashboard', [
            'ideas' => $ideas->paginate(3)
        ]);

    }
}
