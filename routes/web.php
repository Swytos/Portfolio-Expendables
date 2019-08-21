<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::middleware(['auth', 'admin'])->group(function () {
	Route::get('/admin', 'Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/logout', 'Admin\AdminController@logout');

	Route::get('/admin/members', 'Admin\TeamMembersController@teamMembers')->name('admin.team_members');
	Route::get('/admin/new_member', 'Admin\TeamMembersController@createMemberView')->name('admin.new_member');
	Route::get('/admin/edit_member/{member_id}', 'Admin\TeamMembersController@editMemberView')->name('admin.edit_member');
	Route::post('/admin/new_member', 'Admin\TeamMembersController@createMember');
	Route::post('/admin/edit_member/{member_id}', 'Admin\TeamMembersController@editMember');
	Route::post('/admin/removeMember', 'Admin\TeamMembersController@removeMember');

	Route::get('/admin/projects', 'Admin\ProjectsController@projects')->name('admin.projects');
	Route::get('/admin/new_project', 'Admin\ProjectsController@createProjectView')->name('admin.new_project');
	Route::get('/admin/edit_project/{project_id}', 'Admin\ProjectsController@editProjectView')->name('admin.edit_project');
	Route::post('/admin/new_project', 'Admin\ProjectsController@createProject');
	Route::post('/admin/edit_project/{project_id}', 'Admin\ProjectsController@editProject');
	Route::post('/admin/remove_project', 'Admin\ProjectsController@removeProject');

	Route::get('/admin/services', 'Admin\ServicesController@services')->name('admin.services');
    Route::get('/admin/new_service', 'Admin\ServicesController@createServiceView')->name('admin.new_service');
    Route::get('/admin/edit_service/{service_id}', 'Admin\ServicesController@editServiceView')->name('admin.edit_service');
    Route::post('/admin/new_service', 'Admin\ServicesController@createService');
    Route::post('/admin/edit_service/{service_id}', 'Admin\ServicesController@editService');
    Route::post('/admin/removeService', 'Admin\ServicesController@removeService');

    Route::get('/admin/about', 'Admin\AboutController@about')->name('admin.about');
    Route::get('/admin/new_about', 'Admin\AboutController@createAboutView')->name('admin.new_about');
    Route::get('/admin/edit_about/{about_id}', 'Admin\AboutController@editAboutView')->name('admin.edit_about');
    Route::post('/admin/new_about', 'Admin\AboutController@createAbout');
    Route::post('/admin/edit_about/{about_id}', 'Admin\AboutController@editAbout');
    Route::post('/admin/removeAbout', 'Admin\AboutController@removeAbout');

    Route::get('/admin/feedback', 'Admin\FeedbackController@feedback')->name('admin.feedback');
    Route::get('/admin/preview_feedback/{feedback_id}', 'Admin\FeedbackController@createFeedbackView')->name('admin.preview_feedback');
    Route::post('/admin/removeFeedback', 'Admin\FeedbackController@removeFeedback');
    Route::post('/admin/preview_feedback/reply', 'Admin\FeedbackController@replyMessage')->name('admin.reply_message');
});

Route::get('/', 'PortfolioPageController@index')->name('portfolio');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/contact', 'HomeController@mailContact')->name('contact');
Route::get('/blog', 'BlogPageController@index')->name('blog');
