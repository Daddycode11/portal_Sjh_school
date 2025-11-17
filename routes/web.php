<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Faculty\FacultyController;
use App\Http\Controllers\Faculty\FacultyMessagesController;
use App\Http\Controllers\Principal\PrincipalDashboardController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\Principal\TeacherController;
use App\Http\Controllers\Principal\StudentController as PrincipalStudentController;
use App\Http\Controllers\Client\GradeController;
use App\Http\Controllers\Admin\LoginHistoryController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\Faculty\FacultyDashboardController;
use App\Http\Controllers\Faculty\FacultyHomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\AdminGradeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentEnrollmentController;
use App\Http\Controllers\Admin\AdminEnrollmentController;  
use App\Http\Middleware\ClientMiddleware;
use App\Http\Controllers\AdminDashboardController;


/*
|--------------------------------------------------------------------------
| Public/Homepage
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('welcome');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'processLogin'])->name('login.submit');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth','admin'])->name('admin.')->group(function() {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Student Management
    Route::resource('students', StudentController::class); // full CRUD
    Route::delete('/students/{id}', [AdminController::class, 'deleteStudent'])->name('deleteStudent');

    // Faculty Management
    Route::get('/faculty', [AdminController::class, 'facultyList'])->name('faculty.index');
    Route::get('/faculty/create', [AdminController::class, 'createFaculty'])->name('faculty.create');
    Route::post('/faculty', [AdminController::class, 'storeFaculty'])->name('faculty.store');
    Route::get('/faculty/{id}/edit', [AdminController::class, 'editFaculty'])->name('faculty.edit');
    Route::put('/faculty/{id}', [AdminController::class, 'updateFaculty'])->name('faculty.update');

    // Faculty Assignments
    Route::get('/assignments', [AdminController::class, 'assignFaculty'])->name('assignments.index');
    Route::post('/assignments', [AdminController::class, 'storeFacultyAssignment'])->name('assignments.store');
    Route::delete('/assignments/{id}', [AdminController::class, 'deleteFacultyAssignment'])->name('assignments.delete');
    Route::get('/assignments/faculty/{id}', [AdminController::class, 'facultyClasses'])->name('assignments.facultyClasses');

    // Subject Management
    Route::get('/subjects', [AdminController::class, 'listSubjects'])->name('subjects.index');
    Route::get('/subjects/create', [AdminController::class, 'createSubject'])->name('subjects.create');
    Route::post('/subjects', [AdminController::class, 'storeSubject'])->name('subjects.store');
    Route::get('/subjects/{id}/edit', [AdminController::class, 'editSubject'])->name('subjects.edit');
    Route::put('/subjects/{id}', [AdminController::class, 'updateSubject'])->name('subjects.update');

    // Section Student Management
    Route::get('/sections/{sectionId}/students', [AdminController::class, 'showSectionStudents'])->name('sections.showStudents');
    Route::post('/sections/{sectionId}/students', [AdminController::class, 'storeSectionStudents'])->name('sections.storeStudents');
    Route::get('/assignments/section/{sectionId}/enrolled-students', [AdminController::class, 'showEnrolledStudents'])->name('assignments.showEnrolledStudents');

    // Grading System
    Route::get('/grading/{subjectId}/edit', [AdminController::class, 'editGradingSystem'])->name('editGradingSystem');
    Route::put('/grading/{subjectId}', [AdminController::class, 'updateGradingSystem'])->name('updateGradingSystem');

    // Syllabus
    Route::get('/syllabi', [AdminController::class, 'viewTeacherSyllabi'])->name('syllabi.index');

    // Announcements
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    // Login History
    Route::get('/login-history', [LoginHistoryController::class, 'index'])->name('loginHistory');
});
Route::prefix('faculty')->middleware(['auth','faculty'])->name('faculty.')->group(function() {

    // Dashboard
    Route::get('/dashboard', [FacultyDashboardController::class, 'index'])
        ->name('dashboard');
    // Class Management
    Route::get('/classes', [FacultyController::class, 'myClasses'])->name('classes.index');
    Route::get('/classes/{sectionId}/{subjectId}/{schoolYear}/{semester}', [FacultyController::class, 'classDetails'])->name('classes.details');

    // Syllabus
    Route::get('/syllabi', [FacultyController::class, 'listSyllabi'])->name('syllabus.index');
    Route::get('/syllabus/{sectionId}/{subjectId}/{schoolYear}/{semester}/upload', [FacultyController::class, 'uploadSyllabus'])->name('syllabus.upload');
    Route::post('/syllabus/{sectionId}/{subjectId}/{schoolYear}/{semester}', [FacultyController::class, 'storeSyllabus'])->name('syllabus.store');
    Route::get('/syllabus/{id}/download', [FacultyController::class, 'downloadSyllabus'])->name('syllabus.download');

    // Seat Plan
    Route::get('/seatplan/{sectionId}/{subjectId}/{schoolYear}/{semester}/create', [FacultyController::class, 'createSeatPlan'])->name('seatplan.create');
    Route::post('/seatplan/{sectionId}/{subjectId}/{schoolYear}/{semester}', [FacultyController::class, 'storeSeatPlan'])->name('seatplan.store');
    Route::get('/seatplan/{sectionId}/{subjectId}/{schoolYear}/{semester}/view', [FacultyController::class, 'viewSeatPlan'])->name('seatplan.view');

    // Assessment & Scores
    Route::get('/assessment/{sectionId}/{subjectId}/{schoolYear}/{semester}/create', [FacultyController::class, 'createAssessment'])->name('assessment.create');
    Route::post('/assessment/{sectionId}/{subjectId}/{schoolYear}/{semester}', [FacultyController::class, 'storeAssessment'])->name('assessment.store');
    Route::get('/scores/{assessmentId}', [FacultyController::class, 'manageScores'])->name('scores.manage');
    Route::post('/scores/{assessmentId}', [FacultyController::class, 'saveScores'])->name('scores.save');

    // Analytics & Reports
    Route::get('/analytics/{sectionId}/{subjectId}/{schoolYear}/{semester}', [FacultyController::class, 'analytics'])->name('analytics');
    Route::get('/reports/export-excel/{id}', [FacultyController::class, 'exportExcel'])->name('reports.export-excel');
    Route::get('/reports/export-pdf/{id}', [FacultyController::class, 'exportPdf'])->name('reports.export-pdf');
    Route::get('/reports/generate/{sectionId}/{subjectId}/{schoolYear}/{semester}', [FacultyController::class, 'generateReport'])->name('reports.generate');
    Route::post('/reports/download/{sectionId}/{subjectId}/{schoolYear}/{semester}', [FacultyController::class, 'downloadReport'])->name('reports.download');
    Route::get('/reports/view/{id}', [FacultyController::class, 'viewReport'])->name('reports.view');

    // Messages
    Route::get('/messages', [FacultyMessagesController::class, 'index'])->name('messages.index');
    Route::get('/messages/{userId}', [FacultyMessagesController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages', [FacultyMessagesController::class, 'sendMessage'])->name('messages.send');
    Route::get('/messages/check/new', [FacultyMessagesController::class, 'checkNewMessages'])->name('messages.check');
});

/*
|--------------------------------------------------------------------------
| Client/Student Routes
|--------------------------------------------------------------------------
*/
Route::prefix('student')->middleware(['auth','client'])->name('client.')->group(function() {

    // Dashboard
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

    // Classes
    Route::get('/classes', [ClientController::class, 'myClasses'])->name('classes.index');
    Route::get('/classes/{sectionId}/{subjectId}/{schoolYear}/{semester}', [ClientController::class, 'classDetails'])->name('classes.details');

    // Schedules
    Route::get('/schedules', [ClientController::class, 'viewSchedules'])->name('schedules.index');

    // Grades
    Route::get('/grades', [ClientController::class, 'viewGrades'])->name('grades.index');
    Route::get('/grades/export-pdf', [ClientController::class, 'exportGradesPDF'])->name('grades.exportPDF');

    // Messages
    Route::get('/messages', [ClientController::class, 'viewMessages'])->name('messages.index');
    Route::get('/messages/{userId}', [ClientController::class, 'getConversation'])->name('messages.conversation');
    Route::post('/messages', [ClientController::class, 'sendMessage'])->name('messages.send');

    // Syllabus download
    Route::get('/syllabus/{id}/download', [ClientController::class, 'downloadSyllabus'])->name('syllabus.download');
});

/*
|--------------------------------------------------------------------------
| Principal Routes
|--------------------------------------------------------------------------
*/
Route::prefix('principal')->middleware(['auth','principal'])->name('principal.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [PrincipalController::class, 'dashboard'])->name('dashboard');

    // Dynamic Pages
    Route::get('/teachers', [PrincipalController::class, 'teachers'])->name('teachers.index');
    Route::get('/students', [PrincipalController::class, 'students'])->name('students.index');
    Route::get('/sections', [PrincipalController::class, 'sections'])->name('sections.index');
    Route::get('/subjects', [PrincipalController::class, 'subjects'])->name('subjects.index');
    Route::get('/reports', [PrincipalController::class, 'reports'])->name('reports.index');
    Route::get('/settings', [PrincipalController::class, 'settings'])->name('settings');
});
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

      // Students
    Route::get('/students/create', [AdminController::class, 'createStudent'])->name('createStudent');
    Route::post('/students', [AdminController::class, 'storeStudent'])->name('storeStudent');
    Route::delete('/students/{id}', [AdminController::class, 'deleteStudent'])->name('deleteStudent');


    // ✅ View Grades Page
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('viewReports');

    // Validate Enrollment
Route::get('/enrollments/validate', [EnrollmentController::class, 'validateEnrollment'])->name('validateEnrollment'); 

    // Monitor Activities
    Route::get('/activities', [ActivityController::class, 'index'])->name('monitorActivities');

    // Manage Users
    Route::resource('users', UserController::class);

    // Announcements
    Route::resource('announcements', AnnouncementController::class);

    // Login History
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login-history', [AdminController::class, 'loginHistory'])->name('loginHistory');
});
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/grades', [AdminGradeController::class, 'index'])->name('grades.index');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
///Activity Controller
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
});

// -------------------------
// Admin Faculty Management
// -------------------------
Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('faculty', [FacultyController::class, 'index'])->name('faculty.index');
    Route::get('faculty/create', [FacultyController::class, 'create'])->name('faculty.create');
    Route::post('faculty', [FacultyController::class, 'store'])->name('faculty.store');
    Route::get('faculty/{faculty}/edit', [FacultyController::class, 'edit'])->name('faculty.edit');
    Route::put('faculty/{faculty}', [FacultyController::class, 'update'])->name('faculty.update');
    Route::delete('faculty/{faculty}', [FacultyController::class, 'destroy'])->name('faculty.destroy');
});

// -------------------------
// Faculty Dashboard
// -------------------------
// Route::prefix('faculty')
//     ->middleware(['auth', 'isFaculty'])
//     // ->name('faculty.')
//     ->group(function () {
//         Route::get('dashboard', [FacultyDashboardController::class, 'index'])->name('dashboard');
//     });

// Route::prefix('faculty')
//     ->middleware(['auth','isFaculty'])
//     ->group(function() {
//         Route::get('dashboard', [FacultyDashboardController::class, 'index'])->name('dashboard');
// });


Route::prefix('faculty')->middleware(['auth'])->name('faculty.')->group(function() {
    Route::get('dashboard', [FacultyDashboardController::class, 'index'])->name('dashboard');
});
// Admin dashboard & enrollments
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {

    Route::get('dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // All enrollments list
    Route::get('enrollments', [AdminEnrollmentController::class, 'index'])
        ->name('enrollments.index');

    // Pending enrollment requests
    Route::get('enrollments-requests', [AdminEnrollmentController::class, 'requests'])
        ->name('enrollments.requests');

    // Approve / Reject
    Route::post('enrollments/{id}/approve', [AdminEnrollmentController::class, 'approve'])
        ->name('enrollments.approve');

    Route::post('enrollments/{id}/reject', [AdminEnrollmentController::class, 'reject'])
        ->name('enrollments.reject');
});

// Student dashboard and enrollment
Route::middleware(['auth'])->group(function () {

    // Dashboard route MUST use controller to pass variables
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])
        ->name('client.dashboard');

    // Student Enrollment submission
    Route::post('/student/enrollment', [StudentEnrollmentController::class, 'submit'])
        ->name('student.enrollment.submit');
});

//test route
Route::middleware(['auth'])->group(function () {
    Route::get('/student/enrollment', [StudentEnrollmentController::class, 'form'])
        ->name('client.enrollment.form'); // this fixes the error

    Route::post('/student/enrollment', [StudentEnrollmentController::class, 'submit'])
        ->name('student.enrollment.submit');
});
// Student Enrollment Form (full page)
Route::get('/student/enrollment', function () {
    return view('client.enrollment_form');
})->middleware('auth')->name('client.enrollment.form');
