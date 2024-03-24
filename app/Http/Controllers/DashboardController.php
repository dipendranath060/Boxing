<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use App\Models\Event;
use App\Models\News;
use App\Models\Rules;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $news = News::count();
        $events = Event::count();
        $rules = Rules::count();
        $boardMembers = BoardMember::count();
        $currentDateTime = Carbon::now();
        $upcomingEvents = Event::where('start_date', '>', $currentDateTime)->orderBy('start_date')->get();
        return view('admin.dashboard', compact('news', 'events', 'rules', 'boardMembers', 'upcomingEvents'));
    }


    public function profile()
    {
        return view('admin.profile');
    }
}
