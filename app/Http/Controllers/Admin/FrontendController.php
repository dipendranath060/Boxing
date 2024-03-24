<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\Banner;
use App\Models\BoardMember;
use App\Models\Document;
use App\Models\Event;
use App\Models\FieldCoordinator;
use App\Models\Gallery;
use App\Models\MedicalTeam;
use App\Models\Milestone;
use App\Models\News;
use App\Models\Notification;
use App\Models\Rules;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'DESC')->get();
        $milestones = Milestone::all();
        $news = News::orderBy('updated_at', 'DESC')->get();
        $associations = Association::all();
        $currentDateTime = Carbon::now();
        $upcomingEvents = Event::where('start_date', '>', $currentDateTime)->orderBy('start_date', 'desc')->get();
        $notifications = Notification::orderBy('created_at', 'DESC')->get();
        return view('frontend.index', compact('milestones', 'upcomingEvents', 'news', 'associations', 'notifications', 'banners'));
    }

    public function boardMember()
    {
        $boardMembers = BoardMember::all();
        return view('frontend.board-member', compact('boardMembers'));
    }

    public function medicalTeam()
    {
        $medicalTeams = MedicalTeam::all();
        return view('frontend.medical-team', compact('medicalTeams'));
    }

    public function fieldCoordinator()
    {
        $fieldCoordinators = FieldCoordinator::all();
        return view('frontend.field-coordinator', compact('fieldCoordinators'));
    }

    public function rules()
    {
        $rules = Rules::all();
        return view('frontend.rules', compact('rules'));
    }

    public function partnersAssociations()
    {
        $partnersAssociations = Association::all();
        return view('frontend.partners-associations', compact('partnersAssociations'));
    }

    public function event()
    {
        $currentDateTime = Carbon::now();
        $upcomingEvents = Event::where('start_date', '>', $currentDateTime)->orderBy('start_date', 'DESC')->paginate(4);
        $previousEvents = Event::where('expiry_date', '<', Carbon::now())->orderBy('expiry_date', 'desc')->paginate(10);
        return view('frontend.event',compact('upcomingEvents', 'previousEvents'));
    }

    public function gallery()
    {
        $albums = Gallery::paginate(12);
        return view('frontend.gallery', compact('albums'));
    }

    public function news()
    {
        $news = News::orderBy('updated_at', 'DESC')->paginate(9);
        return view('frontend.news', compact('news'));
    }

    public function registration()
    {
        $registrations = Document::all();
        return view('frontend.registration', compact('registrations'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function show_event(string $event_slug)
    {
        $event = Event::where('event_slug', $event_slug)->first();
        $currentDateTime = Carbon::now();
        $upcomingEvents = Event::where('start_date', '>', $currentDateTime)->orderBy('start_date', 'desc')->get();
        return view('frontend.show-event', compact('event', 'upcomingEvents'));
    }

    public function show_gallery(string $album_slug)
    {
        $album = Gallery::where('album_slug', $album_slug)->first();
        $images =[];

        if ($album) {
            $images = json_decode($album->images);
        }
        return view('frontend.show-gallery', compact('album', 'images'));
    }

    public function show_news(string $news_slug)
    {
        $news = News::where('news_slug', $news_slug)->first();
        $upcomingNews = News::orderBy('updated_at', 'DESC')->get();
        return view('frontend.show-news', compact('news', 'upcomingNews'));
    }

    public function downloadDocument(string $id)
    {
        $document = Document::findOrFail($id);

        if ($document) {
            $filePath = storage_path('app/' . $document->document);
    
            // Sanitize the title to remove problematic characters
            $sanitizedTitle = preg_replace('/[\/\\\\]/', '-', $document->title);
    
            return response()->download($filePath, $sanitizedTitle . '.pdf', [], 'inline');
        }
    }

}
