<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

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
Route::get('/', 'Auth\StudentLoginController@showLoginForm')->name('student.login');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout)');

Route::prefix('admin')->group(function()
{
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/', 'AdminController@index')->name('admin.dashboard');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::get('/account','AdminController@account');
Route::post('/account/email','AdminController@edit_email')->name('admin.edit.email');
Route::post('/account/pass','AdminController@edit_pass')->name('admin.edit.pass');
Route::get('/create','AdminController@create');
Route::post('/create','AdminController@store')->name('admin.create');
Route::put('/admins/{id}','AdminController@edit_admin')->name('admin.edit_admin');
Route::put('/admins/{id}/delete','AdminController@destroy_admin')->name('admin.destroy');

Route::get('/messages/{id}/inbox','MessageController@admin_inbox')->name('admin.inbox.show');
Route::get('/messages/{id}/inbox/{inbox}','MessageController@admin_show')->name('admin.message.show');
Route::get('/messages/{id}/inbox/{inbox}/reply','MessageController@admin_reply')->name('admin.message.reply');
Route::post('/messages/inbox/{inbox}/reply','MessageController@reply_store')->name('admin.message.reply.store');
Route::get('/messages/{id}','MessageController@admin_sent_index')->name('admin.message.sent.index');
Route::get('/messages/outbox/{id}','MessageController@admin_sent_show')->name('admin.message.sent.show');
Route::get('/messages/{id}/compose','MessageController@admin_compose_index')->name('admin.message.compose.index');
Route::post('/messages/{id}/compose','MessageController@compose_store')->name('admin.message.compose.store');
Route::put('/messages/{id}/inbox','MessageController@message_inbox_delete')->name('inbox.delete');
Route::put('/messages/{id}','MessageController@message_sent_delete')->name('sent.delete');


Route::get('/teachers', 'AddTeacherController@index')->name('admin.teacher.index');
Route::get('/teachers/create','AddTeacherController@create')->name('admin.teacher.create');
Route::post('/teachers/create','AddTeacherController@store')->name('add-teacher.store');
Route::put('/teachers/{id}/delete','AddTeacherController@destroy')->name('add-teacher.destroy');
Route::delete('/teachers/{id}/subjects','AddTeacherController@schedule_delete')->name('schedule.delete');
Route::post('/teachers/{id}','AddTeacherController@addsubject')->name('addsubject');
Route::get('/teachers/{id}','AddTeacherController@view')->name('schedule.index');
Route::get('/teachers/{id}/export/excel','AddTeacherController@view_excel')->name('teacher_schedule.excel');
Route::put('/teachers/{id}','AddTeacherController@schedule_update')->name('schedule.update');
Route::get('/teachers/{id}/edit','AddTeacherController@edit');
Route::put('/teachers/{id}/edit','AddTeacherController@update')->name('add-teacher.update');
Route::get('/teachers/export/excel','AddTeacherController@teacher_excel')->name('teacher.excel');
Route::post('/teachers/import/excel','AddTeacherController@teacher_import')->name('teacher.import');
Route::get('/add-subject', 'AddSubjectController@create');
Route::post('/add-subject', 'AddSubjectController@store')->name('subject.store');
Route::get('/subjects', 'AddSubjectController@index')->name('subject.show');
Route::delete('/subjects/{id}', 'AddSubjectController@destroy')->name('subject.destroy');
Route::get('/class', 'AddClassController@show')->name('class.show');
Route::get('/class/export/excel','AddClassController@class_excel');
Route::get('/class/{id}', 'AddClassController@view')->name('add-class.show');
Route::put('/class/{id}', 'AddClassController@update')->name('class.update');
Route::delete('/class/{id}', 'AddClassController@destroy')->name('class.destroy');
Route::delete('/class/{id}/subjects', 'Class_Subject_Teacher_Controller@destroy')->name('class_subject.destroy');
Route::get('/class/students/{id}','AdminController@class_list');
Route::get('/class/students/{id}/excel','AdminController@class_list_excel')->name('class_list.excel');
Route::get('/admins','AdminController@admin');
Route::get('/students', 'AdminController@show_student')->name('admin.student.show');
Route::get('/students/{id}', 'AdminController@view_student')->name('admin.student.view');
Route::put('/students/{id}/delete', 'AdminController@destroy_student')->name('admin.student.destroy');
Route::get('/students/export/excel', 'AdminController@student_excel')->name('student.excel');
Route::post('/students/import/excel','AdminController@student_import')->name('student.import');
Route::get('/parents', 'AdminController@show_parent')->name('admin.parent.show');
Route::get('/parents/{id}', 'AdminController@view_parent')->name('admin.parent.view');
Route::put('/parents/{id}/delete', 'AdminController@destroy_parent')->name('admin.parents.destroy');
Route::put('/parents/{id}', 'AdminController@update_parent')->name('admin.edit_parent');    
Route::get('/parents/export/excel', 'AdminController@parent_excel');
Route::post('/parents/import/excel','AdminController@parent_import')->name('parent.import');
Route::get('/admins/{id}/message','MessageController@index')->name('admin.message.index');
Route::post('/admins/{id}/message','MessageController@store')->name('admin.message.store');
Route::get('/students/{id}/message','MessageController@index')->name('admin.student.message.index');
Route::post('/students/{id}/message','MessageController@store')->name('admin.student.message.store');
Route::get('/teachers/{id}/message','MessageController@index')->name('admin.teacher.message.index');
Route::post('/teachers/{id}/message','MessageController@store')->name('admin.teacher.message.store');
Route::get('/parents/{id}/message','MessageController@index')->name('admin.parent.message.index');
Route::post('/parents/{id}/message','MessageController@store')->name('admin.parent.message.store');
Route::get('/calendar','EventController@index');
Route::post('/calendar','EventController@addevent')->name('admin.add_event');

Route::get('/create/students','AdminController@add_student_view');
Route::post('/create/students','AdminController@add_student_store')->name('add-student.store');
Route::get('/create/parents','AdminController@add_parent_view');
Route::post('/create/parents','AdminController@add_parent_store')->name('add-parent.store');
Route::put('/enrollment/{id}/store','AdminController@enrollment_store')->name('parent.enrollment.store');
Route::put('/enrollment/{id}','AdminController@enrollment_destroy')->name('enrollment.destroy');
Route::get('/students/{id}/edit','AdminController@edit_student');
Route::put('/students/{id}/edit','AdminController@update_student')->name('admin.update_student');
Route::get('/parents/{id}/edit','AdminController@edit_parent');
Route::put('/parents/{id}/edit','AdminController@update_parent')->name('add-parent.update');
Route::get('/search/students/','AdminController@search_student')->name('search_student');
Route::get('/search/admins/','AdminController@search_admin')->name('search_admin');
Route::get('/search/parents/','AdminController@search_parent')->name('search_parent');
Route::get('/search/teachers/','AdminController@search_teacher')->name('search_teacher');
});

Route::prefix('teacher')->group(function()
{
Route::get('/login', 'Auth\TeacherLoginController@showLoginForm')->name('teacher.login');
Route::post('/login', 'Auth\TeacherLoginController@login')->name('teacher.login.submit');
Route::get('/', 'TeacherController@index')->name('teacher.dashboard');
Route::get('/logout', 'Auth\TeacherLoginController@logout')->name('teacher.logout');
Route::post('/password/email', 'Auth\TeacherForgotPasswordController@sendResetLinkEmail')->name('teacher.password.email');
Route::get('/password/reset', 'Auth\TeacherForgotPasswordController@showLinkRequestForm')->name('teacher.password.request');
Route::post('/password/reset', 'Auth\TeacherResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\TeacherResetPasswordController@showResetForm')->name('teacher.password.reset');
Route::get('/account','TeacherController@account');
Route::post('/account/email','TeacherController@edit_email')->name('teacher.edit.email');
Route::post('/account/pass','TeacherController@edit_pass')->name('teacher.edit.pass');
Route::get('/subjects','TeacherController@class')->name('teachers.subject');
Route::get('/subjects/{id}','TeacherController@subject')->name('subject.index');
Route::get('/subjects/{id}/export/excel','TeacherController@grade_excel')->name('grade.excel');
Route::post('/subjects/{id}/lectures','LectureController@store')->name('lecture.store');
Route::get('/exams/{id}/create','ExamController@index')->name('exam.index');
Route::post('/exams/{id}/create','ExamController@store')->name('exam.store');
Route::get('/exams/{id}','ExamController@show')->name('exam.show');
Route::get('/exams/{id}/results','TeacherController@showresult')->name('exam.results');
Route::get('/exams/edit/{id}','ExamController@edit')->name('exam.edit');
Route::put('/exams/edit/{id}','ExamController@update')->name('exam.update');
Route::delete('/exams/{id}','ExamController@delete')->name('exam.delete');
Route::get('/questions/{id}','QuestionController@index')->name('question.index');
Route::get('/questions/exams/{id}','QuestionController@show')->name('questions.show');
Route::delete('/questions/exams/{id}','QuestionController@delete')->name('questions.delete');
Route::get('/questions/exams/edit/{id}','QuestionController@edit')->name('questions.edit');
Route::put('/questions/exams/edit/{id}','QuestionController@update')->name('questions.update');
Route::post('/questions/{id}','QuestionController@store')->name('question.store');
Route::get('/subjects/{id}/assignment','AssignmentController@index')->name('assignment.index');
Route::post('/subjects/{id}/assignment','AssignmentController@store')->name('assignment.store');
Route::get('/subjects/assignment/{id}','AssignmentController@show')->name('assignment.show');
Route::delete('/subjects/assignment/{id}','AssignmentController@delete')->name('assignment.delete');
Route::get('/subjects/assignment/edit/{id}','AssignmentController@edit')->name('assignment.edit');
Route::put('/subjects/assignment/edit/{id}','AssignmentController@update')->name('assignment.update');
Route::get('/subjects/assignment/result/{id}','Student_AssignmentController@show')->name('assignment.result');
Route::put('/subjects/assignment/result/{id}','AssignmentController@grade')->name('student.store.assignment');
Route::post('/subjects/{id}/grades','TeacherController@grade_subject_store')->name('grade-subject.store');
Route::put('/subjects/{id}/grades','TeacherController@grade_subject_update')->name('grade-subject.update');
Route::get('/subjects/{subject}/grades/{id}','TeacherController@grade_index')->name('teacher.grade.show');
Route::get('/subjects/announcements/{id}', 'TeacherController@subject_announcement_create')->name('subject.announcement.create');
Route::post('/subjects/announcements/{id}', 'TeacherController@subject_announcement_store')->name('subject.announcement.store');
Route::get('/subjects/announcements/{id}/edit', 'TeacherController@subject_announcement_edit')->name('subject.announcement.edit');
Route::put('/subjects/announcements/{id}/edit', 'TeacherController@subject_announcement_update')->name('subject.announcement.update');
Route::delete('/subjects/{id}', 'TeacherController@subject_announcement_destroy')->name('subject.announcement.destroy');
Route::get('/class','TeacherController@adviser')->name('adviser.show');
Route::get('/class/grades/{id}', 'TeacherController@adviser_grade')->name('adviser.grade.show');
Route::get('/class/announcements/{id}', 'TeacherController@announcement_create')->name('announcement.create');
Route::post('/class/announcements/{id}', 'TeacherController@announcement_store')->name('announcement.store');
Route::get('/class/announcements/{id}/edit', 'TeacherController@announcement_edit')->name('announcement.edit');
Route::put('/class/announcements/{id}/edit', 'TeacherController@announcement_update')->name('announcement.update');
Route::delete('/class/{id}', 'TeacherController@announcement_destroy')->name('announcement.destroy');

Route::get('student/profile/{profile}', 'ProfileController@student_show')->name('teacher.student.profile');


Route::get('/{id}/message','MessageController@index')->name('teacher.message.index');
Route::post('/{id}/message','MessageController@store')->name('teacher.message.store');
Route::get('/student/{id}/message','MessageController@index')->name('teacher.student.message.index');
Route::post('/student/{id}/message','MessageController@store')->name('teacher.student.message.store');
Route::get('/parent/{id}/message','MessageController@index')->name('teacher.parent.message.index');
Route::post('/parent/{id}/message','MessageController@store')->name('teacher.parent.message.store');

Route::get('/messages/{id}/inbox','MessageController@teacher_inbox')->name('teacher.inbox.show');
Route::get('/messages/{id}/inbox/{inbox}','MessageController@teacher_show')->name('teacher.message.show');
Route::get('/messages/{id}/inbox/{inbox}/reply','MessageController@teacher_reply')->name('teacher.message.reply');
Route::post('/messages/inbox/{inbox}/reply','MessageController@reply_store')->name('teacher.message.reply.store');
Route::get('/messages/{id}','MessageController@teacher_sent_index')->name('teacher.message.sent.index');
Route::get('/messages/outbox/{id}','MessageController@teacher_sent_show')->name('teacher.message.sent.show');
Route::put('/messages/{id}/inbox','MessageController@message_inbox_delete')->name('inbox.delete');
Route::put('/messages/{id}','MessageController@message_sent_delete')->name('sent.delete');

Route::get('/profile/{id}','Teacher_ProfileController@index')->name('teacher.profile.index');
Route::get('/profile/{id}/edit','Teacher_ProfileController@edit')->name('teacher.profile.edit');
Route::put('/profile/{id}/edit','Teacher_ProfileController@update')->name('teacher.profile.update');
Route::put('/profile/{id}','Teacher_ProfileController@update_pic')->name('teacher.profile_pic.update');

Route::get('/calendar','EventController@index');
Route::post('/calendar','EventController@addevent')->name('teacher.add_event');
Route::get('/exam/analysis/{id}','ExamController@item_analysis')->name('item.analysis');
});

Route::prefix('parent')->group(function()
{
Route::get('/login', 'Auth\ParentLoginController@showLoginForm')->name('parent.login');
Route::post('/login', 'Auth\ParentLoginController@login')->name('parent.login.submit');
Route::get('/', 'ParentController@index')->name('parent.dashboard');
Route::get('/logout', 'Auth\ParentLoginController@logout')->name('parent.logout');
Route::post('/password/email', 'Auth\ParentForgotPasswordController@sendResetLinkEmail')->name('parent.password.email');
Route::get('/password/reset', 'Auth\ParentForgotPasswordController@showLinkRequestForm')->name('parent.password.request');
Route::post('/password/reset', 'Auth\ParentResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\ParentResetPasswordController@showResetForm')->name('parent.password.reset');
Route::get('/account','ParentController@account');
Route::post('/account/email','ParentController@edit_email')->name('parent.edit.email');
Route::post('/account/pass','ParentController@edit_pass')->name('parent.edit.pass');

Route::get('/classes','ParentController@class')->name('parent.class');
Route::get('/classes/{id}','ParentController@class_id')->name('parent.class_id');
Route::get('/classes/{student}/subjects/{id}/','ParentController@subject')->name('parent.subject');

Route::get('/students/profile/{id}', 'ParentController@student_profile')->name('parent.student.profile');

Route::get('/teachers/profile/{id}', 'ProfileController@teacher_show')->name('parent.teacher.profile');
Route::get('/teachers/{id}/message','MessageController@index')->name('parent.message.teacher.index');
Route::post('/teachers/{id}/message','MessageController@store')->name('parent.message.teacher.store');
Route::get('/students/{id}/message','MessageController@index')->name('parent.message.student.index');
Route::post('/students/{id}/message','MessageController@store')->name('parent.message.student.store');

Route::get('/classes/exams/{id}/results','Exam_GradeController@parent_show')->name('parent.show.result');
Route::get('/classes/assignments/{id}/results','ParentController@assignment')->name('parent.assignment.show');

Route::get('/messages/{id}/inbox','MessageController@parent_inbox')->name('parent.inbox.show');
Route::get('/messages/{id}/inbox/{inbox}','MessageController@parent_show')->name('parent.message.show');
Route::get('/messages/{id}/inbox/{inbox}/reply','MessageController@parent_reply')->name('parent.message.reply');
Route::post('/messages/inbox/{inbox}/reply','MessageController@reply_store')->name('parent.message.reply.store');
Route::get('/messages/{id}','MessageController@parent_sent_index')->name('parent.message.sent.index');
Route::get('/messages/outbox/{id}','MessageController@parent_sent_show')->name('parent.message.sent.show');
Route::put('/messages/{id}/inbox','MessageController@message_inbox_delete')->name('inbox.delete');
Route::put('/messages/{id}','MessageController@message_sent_delete')->name('sent.delete');

Route::get('/students/grades','ParentController@grade_index');
Route::get('/students/grades/{id}','ParentController@grade_student');
Route::get('/students/grades/{id}/{student}','ParentController@grade');
});

Route::prefix('student')->group(function()
{
Route::get('/login', 'Auth\StudentLoginController@showLoginForm')->name('student.login');
Route::post('/login', 'Auth\StudentLoginController@login')->name('student.login.submit');
Route::get('/', 'StudentController@index')->name('student.dashboard');
Route::get('/logout', 'Auth\StudentLoginController@logout')->name('student.logout');
Route::post('/password/email', 'Auth\StudentForgotPasswordController@sendResetLinkEmail')->name('student.password.email');
Route::get('/password/reset', 'Auth\StudentForgotPasswordController@showLinkRequestForm')->name('student.password.request');
Route::post('/password/reset', 'Auth\StudentResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\StudentResetPasswordController@showResetForm')->name('student.password.reset');
Route::get('/account','StudentController@account');
Route::post('/account/email','StudentController@edit_email')->name('student.edit.email');
Route::post('/account/pass','StudentController@edit_pass')->name('student.edit.pass');
Route::get('/subjects','Class_StudentController@subject_list')->name('subject.list.show');
Route::get('/class','Class_StudentController@showclass')->name('student.show.class');
Route::get('/class/{id}','Class_StudentController@subject')->name('student.show.subject');
Route::get('/class/exam/{id}','Class_StudentController@exam')->name('student.show.exam');
Route::get('/class/exam/{id}/questions','Class_StudentController@question')->name('student.show.question');
Route::get('/class/exam/{id}/results','Exam_GradeController@show')->name('student.show.result');
Route::post('/class/exam/{id}/questions','AnswerController@store')->name('student.store.answer');

Route::post('/class/exam/{id}/results','Exam_GradeController@store')->name('store.result');
Route::get('/class/assignment/{id}','Class_StudentController@showassignment')->name('student.assignment.show');
Route::post('/class/assignment/{id}','Student_AssignmentController@store')->name('student.assignment.store');

Route::get('teachers/profile/{profile}', 'ProfileController@teacher_show')->name('student.teacher.profile');

Route::get('/{id}/message','MessageController@index')->name('message.index');
Route::post('/{id}/message','MessageController@store')->name('message.store');

Route::get('teachers/{id}/message','MessageController@index')->name('message.teacher.index');
Route::post('teachers/{id}/message','MessageController@store')->name('message.teacher.store');


Route::get('/messages/{id}/inbox','MessageController@student_inbox')->name('student.inbox.show');
Route::get('/messages/{id}/inbox/{inbox}','MessageController@student_show')->name('student.message.show');
Route::get('/messages/{id}/inbox/{inbox}/reply','MessageController@student_reply')->name('student.message.reply');
Route::post('/messages/inbox/{inbox}/reply','MessageController@reply_store')->name('student.message.reply.store');
Route::get('/messages/{id}','MessageController@student_sent_index')->name('student.message.sent.index');
Route::get('/messages/outbox/{id}','MessageController@student_sent_show')->name('student.message.sent.show');
Route::put('/messages/{id}/inbox','MessageController@message_inbox_delete')->name('inbox.delete');
Route::put('/messages/{id}','MessageController@message_sent_delete')->name('sent.delete');

Route::get('/class', 'Class_StudentController@showclass')->name('student.grade.show');


Route::get('/profile/{id}', 'ProfileController@student_show')->name('student.profile');
Route::get('/profile/{id}/edit','ProfileController@edit')->name('student.profile.edit');
Route::put('/profile/{id}/edit','ProfileController@update')->name('student.profile.update');
Route::put('/profile/{id}/','ProfileController@update_pic')->name('student.profile_pic.update');

Route::get('/calendar','EventController@index');
Route::post('/calendar','EventController@addevent')->name('student.add_event');


Route::get('/grades/{id}','Class_StudentController@grade');
Route::get('/schedule/{id}','Class_StudentController@schedule');
Route::post('/class/exam/{id}/questions/start','Class_StudentController@quiz_start')->name('student.store.quiz_start');

});






Route::put('admin/subjects/{id}', 'AddSubjectController@update')->name('subject.update');
Route::get('admin/view-students/profile/{profile}', 'ProfileController@show');

Route::get('admin/add-class', 'AddClassController@index');
Route::post('admin/add-class', 'AddClassController@store')->name('add-class.store');


Route::post('admin/class/{id}', 'Class_Subject_Teacher_Controller@store')->name('addsubjtoclass.store');
Route::put('admin/class/schedule/{id}', 'Class_Subject_Teacher_Controller@update')->name('addsubjtoclass.update');




Route::post('admin/add-class/store', 'AddClassController@store');


