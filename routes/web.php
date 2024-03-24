<?php

use App\Http\Controllers\Admin\AssociationController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BoardMemberController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FieldCoordinatorController;
use App\Http\Controllers\Admin\FrontendController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MedicalTeamController;
use App\Http\Controllers\Admin\MilestoneController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RulesController;
use App\Http\Controllers\Admin\SendMailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('homes');
Route::get('/board-members', [FrontendController::class, 'boardMember'])->name('board-member');
Route::get('/medical-team', [FrontendController::class, 'medicalTeam'])->name('medical-team');
Route::get('/field-coordinators', [FrontendController::class, 'fieldCoordinator'])->name('field-coordinator');
Route::get('/rules-and-regulations', [FrontendController::class, 'rules'])->name('rule');
Route::get('/partners-and-associations', [FrontendController::class, 'partnersAssociations'])->name('partners');
Route::get('/events', [FrontendController::class, 'event'])->name('event');
Route::get('/event/{event_slug}', [FrontendController::class, 'show_event'])->name('show-event');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('fgallery');
Route::get('/gallery/{album_slug}', [FrontendController::class, 'show_gallery'])->name('show-gallery');
Route::get('/news', [FrontendController::class, 'news'])->name('fnews');
Route::get('/news/{news_slug}', [FrontendController::class, 'show_news'])->name('show-fnews');

Route::get('/registration', [FrontendController::class, 'registration'])->name('registration');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/sendMail', [SendMailController::class, 'index'])->name('sendMail');
Route::get('/download/{id}', [FrontendController::class, 'downloadDocument'])->name('fdownload');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Authenticated Routes Starts Here
Auth::routes();

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');


    //Routes for Member Association
    Route::get('/member-associations', [AssociationController::class, 'index'])->name('associations');
    Route::get('/add-member-association', [AssociationController::class, 'create'])->name('add-association');
    Route::post('/add-member-association', [AssociationController::class, 'store']);
    Route::get('/edit-member-association/{id}', [AssociationController::class, 'edit'])->name('edit-association');
    Route::put('/update-member-association/{id}', [AssociationController::class, 'update'])->name('update-association');
    Route::delete('/delete-member-association/{id}', [AssociationController::class, 'destroy'])->name('delete-association');

    //Routes for Board Members
    Route::get('/board-members', [BoardMemberController::class, 'index'])->name('board-members');
    Route::get('/add-board-member', [BoardMemberController::class, 'create'])->name('add-board-member');
    Route::post('/add-board-member', [BoardMemberController::class, 'store']);
    Route::get('/edit-board-member/{id}', [BoardMemberController::class, 'edit'])->name('edit-board-member');
    Route::put('/update-board-member/{id}', [BoardMemberController::class, 'update'])->name('update-board-member');
    Route::delete('/delete-board-member/{id}', [BoardMemberController::class, 'destroy'])->name('delete-board-member');

    //Routes for Medical Members
    Route::get('/medical-members', [MedicalTeamController::class, 'index'])->name('medical-members');
    Route::get('/add-medical-member', [MedicalTeamController::class, 'create'])->name('add-medical-member');
    Route::post('/add-medical-member', [MedicalTeamController::class, 'store']);
    Route::get('/edit-medical-member/{id}', [MedicalTeamController::class, 'edit'])->name('edit-medical-member');
    Route::put('/update-medical-member/{id}', [MedicalTeamController::class, 'update'])->name('update-medical-member');
    Route::delete('/delete-medical-member/{id}', [MedicalTeamController::class, 'destroy'])->name('delete-medical-member');

    //Routes for field Coordinator Members
    Route::get('/field-coordinator-members', [FieldCoordinatorController::class, 'index'])->name('coordinator-members');
    Route::get('/add-field-coordinator-member', [FieldCoordinatorController::class, 'create'])->name('add-coordinator-member');
    Route::post('/add-field-coordinator-member', [FieldCoordinatorController::class, 'store']);
    Route::get('/edit-field-coordinator-member/{id}', [FieldCoordinatorController::class, 'edit'])->name('edit-coordinator-member');
    Route::put('/update-field-coordinator-member/{id}', [FieldCoordinatorController::class, 'update'])->name('update-coordinator-member');
    Route::delete('/delete-field-coordinator-member/{id}', [FieldCoordinatorController::class, 'destroy'])->name('delete-coordinator-member');

    //Routes for Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('/add-gallery', [GalleryController::class, 'create'])->name('add-gallery');
    Route::post('/add-gallery', [GalleryController::class, 'store']);
    Route::get('/edit-gallery/{id}', [GalleryController::class, 'edit'])->name('edit-gallery');
    Route::put('/update-gallery/{id}', [GalleryController::class, 'update'])->name('update-gallery');
    Route::delete('/delete-gallery/{id}', [GalleryController::class, 'destroy'])->name('delete-gallery');

    //Routes for Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/add-category', [CategoryController::class, 'create'])->name('add-category');
    Route::post('/add-category', [CategoryController::class, 'store']);
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-category');
    Route::put('/update-category/{id}', [CategoryController::class, 'update'])->name('update-category');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'destroy'])->name('delete-category');

    //Routes for News
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/add-news', [NewsController::class, 'create'])->name('add-news');
    Route::post('/add-news', [NewsController::class, 'store']);
    Route::get('/edit-news/{id}', [NewsController::class, 'edit'])->name('edit-news');
    Route::put('/update-news/{id}', [NewsController::class, 'update'])->name('update-news');
    Route::get('/show-news/{id}', [NewsController::class, 'show'])->name('show-news');
    Route::delete('/delete-news/{id}', [NewsController::class, 'destroy'])->name('delete-news');

    //Routes for Events
    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::get('/add-event', [EventController::class, 'create'])->name('add-event');
    Route::post('/add-event', [EventController::class, 'store']);
    Route::get('/edit-event/{id}', [EventController::class, 'edit'])->name('edit-event');
    Route::put('/update-event/{id}', [EventController::class, 'update'])->name('update-event');
    Route::delete('/delete-event/{id}', [EventController::class, 'destroy'])->name('delete-event');

    //Routes for Rules and Regulations
    Route::get('/rules', [RulesController::class, 'index'])->name('rules');
    Route::get('/add-rule', [RulesController::class, 'create'])->name('add-rule');
    Route::post('/add-rule', [RulesController::class, 'store']);
    Route::get('/edit-rule/{id}', [RulesController::class, 'edit'])->name('edit-rule');
    Route::put('/update-rule/{id}', [RulesController::class, 'update'])->name('update-rule');
    Route::get('/show-rule/{id}', [RulesController::class, 'show'])->name('show-rule');
    Route::delete('/delete-rule/{id}', [RulesController::class, 'destroy'])->name('delete-rule');

    //Routes for Milestones
    Route::get('/milestones', [MilestoneController::class, 'index'])->name('milestones');
    Route::get('/add-milestone', [MilestoneController::class, 'create'])->name('add-milestone');
    Route::post('/add-milestone', [MilestoneController::class, 'store']);
    Route::get('/edit-milestone/{id}', [MilestoneController::class, 'edit'])->name('edit-milestone');
    Route::put('/update-milestone/{id}', [MilestoneController::class, 'update'])->name('update-milestone');
    Route::delete('/delete-milestone/{id}', [MilestoneController::class, 'destroy'])->name('delete-milestone');

    //Routes for Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::get('/add-notification', [NotificationController::class, 'create'])->name('add-notification');
    Route::post('/add-notification', [NotificationController::class, 'store']);
    Route::get('/edit-notification/{id}', [NotificationController::class, 'edit'])->name('edit-notification');
    Route::put('/update-notification/{id}', [NotificationController::class, 'update'])->name('update-notification');
    Route::delete('/delete-notification/{id}', [NotificationController::class, 'destroy'])->name('delete-notification');

    //Routes for Documents
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
    Route::get('/add-document', [DocumentController::class, 'create'])->name('add-document');
    Route::post('/add-document', [DocumentController::class, 'store']);
    Route::get('/edit-document/{id}', [DocumentController::class, 'edit'])->name('edit-document');
    Route::put('/update-document/{id}', [DocumentController::class, 'update'])->name('update-document');
    Route::delete('/delete-document/{id}', [DocumentController::class, 'destroy'])->name('delete-document');
    Route::get('/download/{id}', [DocumentController::class, 'download'])->name('download');
        

     //Routes for Banners
     Route::get('/banners', [BannerController::class, 'index'])->name('banners');
     Route::get('/add-banner', [BannerController::class, 'create'])->name('add-banner');
     Route::post('/add-banner', [BannerController::class, 'store']);
     Route::get('/edit-banner/{id}', [BannerController::class, 'edit'])->name('edit-banner');
     Route::put('/update-banner/{id}', [BannerController::class, 'update'])->name('update-banner');
     Route::delete('/delete-banner/{id}', [BannerController::class, 'destroy'])->name('delete-banner');

    //Routes for User
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/add-user', [UserController::class, 'create'])->name('add-user');
    Route::post('/add-user', [UserController::class, 'store']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::put('/update-user/{id}', [UserController::class, 'update'])->name('update-user');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('delete-user');
});