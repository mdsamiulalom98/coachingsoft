<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\StudentManageController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\AboutusController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SuccessStudentController;
use App\Http\Controllers\Frontend\StudentController;
use App\Http\Controllers\Frontend\FrontEndController;
use App\Http\Controllers\Frontend\ShoppingController;

Auth::routes();



// auth route
Route::group(['namespace' => 'Frontend'], function () {

    Route::get('/', [FrontEndController::class, 'index'])->name('home');
    Route::get('/courses', [FrontEndController::class, 'courses'])->name('courses');
    Route::get('/course-details', [FrontEndController::class, 'course_details'])->name('course.details');
    Route::post('course-order/save', [FrontendController::class, 'course_order'])->name('course.order.save');
    Route::get('/books', [FrontEndController::class, 'books'])->name('books');
    Route::get('/book-details', [FrontEndController::class, 'book_details'])->name('book.details');
    Route::get('/success.student', [FrontEndController::class, 'success_student'])->name('success.student');
    Route::get('/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
    Route::get('/notice', [FrontEndController::class, 'notice'])->name('notice');
    Route::get('notice-details/{id}', [FrontendController::class, 'notice_details'])->name('notice.details');


    Route::post('cart/store', [ShoppingController::class, 'cart_store'])->name('cart.store');
    Route::get('cart/remove', [ShoppingController::class, 'cart_remove'])->name('cart.remove');
    Route::get('cart/remove-bn', [ShoppingController::class, 'cart_remove_bn'])->name('cart.remove_bn');
    Route::get('cart/content', [ShoppingController::class, 'cart_content'])->name('cart.content');
    Route::get('cart/count', [ShoppingController::class, 'cart_count'])->name('cart.count');

});
Route::group(['namespace' => 'FrontEnd'], function () {

    Route::get('/login', [StudentController::class, 'login'])->name('student.login');
    Route::post('/signin', [StudentController::class, 'signin'])->name('student.signin');
    Route::get('/register', [StudentController::class, 'register'])->name('student.register');
    Route::post('/store', [StudentController::class, 'store'])->name('student.save');
    Route::get('/verify', [StudentController::class, 'verify'])->name('student.verify');
    Route::post('/account-verify', [StudentController::class, 'account_verify'])->name('student.account_verify');

    // Route::post('/resend-otp', [StudentController::class, 'resendotp'])->name('student.resend_otp');

    Route::get('/forgot-password', [StudentController::class, 'forgot_password'])->name('student.forgot.password');
    Route::post('/forgot-verify', [StudentController::class, 'forgot_verify'])->name('student.forgot.verify');
    Route::get('/forgot-password/reset', [StudentController::class, 'forgot_reset'])->name('student.forgot.reset');
    Route::post('/forgot-password/store', [StudentController::class, 'forgot_store'])->name('student.forgot.store');

    Route::post('/order/save', [StudentController::class, 'order_save'])->name('order.save');
});

Route::group(['namespace' => 'FrontEnd', 'middleware' => ['student']], function () {

    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/enrollcourse', [StudentController::class, 'enrollcourse'])->name('student.enrollcourse');
    Route::get('/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::post('/profile-update', [StudentController::class, 'profile_update'])->name('student.profile_update');
    Route::get('/change-password', [StudentController::class, 'change_pass'])->name('student.change_pass');
    Route::post('/password-update', [StudentController::class, 'password_update'])->name('student.password_update');
    Route::post('/student-logout', [StudentController::class, 'logout'])->name('student.logout');

});


    Route::get('/ajax-product-subcategory', [LessonController::class, 'getSubcategory']);

Route::group(['namespace' => 'Admin', 'middleware' => ['auth'], 'prefix' => 'admin'], function () {

    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('admin.profile');

    Route::get('users/manage', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/save', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/update', [UserController::class, 'update'])->name('users.update');
    Route::post('users/inactive', [UserController::class, 'inactive'])->name('users.inactive');
    Route::post('users/active', [UserController::class, 'active'])->name('users.active');
    Route::post('users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('users/change-password', [UserController::class, 'change_password'])->name('users.change_password');

    // roles
    Route::get('roles/manage', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{id}/show', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/save', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::post('roles/destroy', [RoleController::class, 'destroy'])->name('roles.destroy');

    // permissions
    Route::get('permissions/manage', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('permissions/{id}/show', [PermissionController::class, 'show'])->name('permissions.show');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions/save', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/destroy', [RoleController::class, 'destroy'])->name('permissions.destroy');

    // setting
    Route::get('general-setting/manage', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('general-setting/update', [SettingController::class, 'update'])->name('settings.update');

    // department
    Route::get('department/manage', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('department/create', [DepartmentController::class, 'create'])->name('departments.create');
    Route::post('department/save', [DepartmentController::class, 'store'])->name('departments.store');
    Route::get('department/{id}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
    Route::post('department/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::post('department/inactive', [DepartmentController::class, 'inactive'])->name('departments.inactive');
    Route::post('department/active', [DepartmentController::class, 'active'])->name('departments.active');

    // classroom
    Route::get('classroom/manage', [ClassroomController::class, 'index'])->name('classrooms.index');
    Route::get('classroom/create', [ClassroomController::class, 'create'])->name('classrooms.create');
    Route::post('classroom/save', [ClassroomController::class, 'store'])->name('classrooms.store');
    Route::get('classroom/{id}/edit', [ClassroomController::class, 'edit'])->name('classrooms.edit');
    Route::post('classroom/update', [ClassroomController::class, 'update'])->name('classrooms.update');
    Route::post('classroom/inactive', [ClassroomController::class, 'inactive'])->name('classrooms.inactive');
    Route::post('classroom/active', [ClassroomController::class, 'active'])->name('classrooms.active');
    Route::get('classroom/ajax', [ClassroomController::class, 'ajax_class'])->name('classrooms.ajax_class');

    // classroom
    Route::get('session/manage', [SessionController::class, 'index'])->name('sessions.index');
    Route::get('session/create', [SessionController::class, 'create'])->name('sessions.create');
    Route::post('session/save', [SessionController::class, 'store'])->name('sessions.store');
    Route::get('session/{id}/edit', [SessionController::class, 'edit'])->name('sessions.edit');
    Route::post('session/update', [SessionController::class, 'update'])->name('sessions.update');
    Route::post('session/inactive', [SessionController::class, 'inactive'])->name('sessions.inactive');
    Route::post('session/active', [SessionController::class, 'active'])->name('sessions.active');

    // batches
    Route::get('batch/manage', [BatchController::class, 'index'])->name('batches.index');
    Route::get('batch/create', [BatchController::class, 'create'])->name('batches.create');
    Route::post('batch/save', [BatchController::class, 'store'])->name('batches.store');
    Route::get('batch/{id}/edit', [BatchController::class, 'edit'])->name('batches.edit');
    Route::post('batch/update', [BatchController::class, 'update'])->name('batches.update');
    Route::post('batch/inactive', [BatchController::class, 'inactive'])->name('batches.inactive');
    Route::post('batch/active', [BatchController::class, 'active'])->name('batches.active');

    

    // student
    Route::get('student/ajax-batch', [StudentManageController::class, 'ajax_batch'])->name('students.ajax_batch');
    Route::get('student/ajax-student', [StudentManageController::class, 'ajax_student'])->name('students.ajax_student');
    Route::get('student/manage', [StudentManageController::class, 'index'])->name('students.index');
    Route::get('student/add', [StudentManageController::class, 'create'])->name('students.create');
    Route::post('student/save', [StudentManageController::class, 'store'])->name('students.store');
    Route::get('student/{id}/edit', [StudentManageController::class, 'edit'])->name('students.edit');
    Route::post('student/update', [StudentManageController::class, 'update'])->name('students.update');
    Route::post('student/inactive', [StudentManageController::class, 'inactive'])->name('students.inactive');
    Route::post('student/active', [StudentManageController::class, 'active'])->name('students.active');

    // attendances
    Route::get('attendance/list', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('attendance/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('attendance/save', [AttendanceController::class, 'store'])->name('attendances.store');

    // payments
    Route::get('payment/list', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payment/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payment/save', [PaymentController::class, 'store'])->name('payments.store');
    Route::get('payment/invoice', [PaymentController::class, 'invoice'])->name('payments.invoice');
    
    // contact
    Route::get('contact/manage', [ContactController::class, 'index'])->name('contact.index');
    Route::post('contact/update', [ContactController::class, 'update'])->name('contact.update');

    // contact
    Route::get('about/manage', [AboutusController::class, 'index'])->name('about.index');
    Route::post('about/update', [AboutusController::class, 'update'])->name('about.update');


    // banners
    Route::get('banner/manage', [BannerController::class, 'index'])->name('banners.index');
    Route::get('banner/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('banner/save', [BannerController::class, 'store'])->name('banners.store');
    Route::get('banner/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::post('banner/update', [BannerController::class, 'update'])->name('banners.update');
    Route::post('banner/inactive', [BannerController::class, 'inactive'])->name('banners.inactive');
    Route::post('banner/active', [BannerController::class, 'active'])->name('banners.active');
    Route::post('banner/delete', [BannerController::class, 'destroy'])->name('banners.destroy');

    // Notice
    Route::get('notice/manage', [NoticeController::class, 'index'])->name('notices.index');
    Route::get('notice/create', [NoticeController::class, 'create'])->name('notices.create');
    Route::post('notice/save', [NoticeController::class, 'store'])->name('notices.store');
    Route::get('notice/{id}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
    Route::post('notice/update', [NoticeController::class, 'update'])->name('notices.update');
    Route::post('notice/inactive', [NoticeController::class, 'inactive'])->name('notices.inactive');
    Route::post('notice/active', [NoticeController::class, 'active'])->name('notices.active');
    Route::post('notice/delete', [NoticeController::class, 'destroy'])->name('notices.destroy');


    // mentor
    Route::get('mentor/manage', [MentorController::class, 'index'])->name('mentors.index');
    Route::get('mentor/create', [MentorController::class, 'create'])->name('mentors.create');
    Route::post('mentor/save', [MentorController::class, 'store'])->name('mentors.store');
    Route::get('mentor/{id}/edit', [MentorController::class, 'edit'])->name('mentors.edit');
    Route::post('mentor/update', [MentorController::class, 'update'])->name('mentors.update');
    Route::post('mentor/inactive', [MentorController::class, 'inactive'])->name('mentors.inactive');
    Route::post('mentor/active', [MentorController::class, 'active'])->name('mentors.active');
    Route::post('mentor/delete', [MentorController::class, 'destroy'])->name('mentors.destroy');
    
    // course
    Route::get('course/manage', [CourseController::class, 'index'])->name('courses.index');
    Route::get('course/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('course/save', [CourseController::class, 'store'])->name('courses.store');
    Route::get('course/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('course/update', [CourseController::class, 'update'])->name('courses.update');
    Route::post('course/inactive', [CourseController::class, 'inactive'])->name('courses.inactive');
    Route::post('course/active', [CourseController::class, 'active'])->name('courses.active');
    Route::post('course/delete', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::get('course/payment', [CourseController::class, 'enroll_payment'])->name('enroll.payment');
    Route::get('enroll/details/{id}', [CourseController::class, 'enroll_details'])->name('enroll.payment.details');
    Route::post('enroll/payment-update', [CourseController::class, 'payment_update'])->name('course.online.payment_update');

    // Category
    Route::get('category/manage', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('category/save', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('category/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('category/inactive', [CategoryController::class, 'inactive'])->name('categories.inactive');
    Route::post('category/active', [CategoryController::class, 'active'])->name('categories.active');
    Route::post('category/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    // book
    Route::get('book/manage', [BookController::class, 'index'])->name('books.index');
    Route::get('book/create', [BookController::class, 'create'])->name('books.create');
    Route::post('book/save', [BookController::class, 'store'])->name('books.store');
    Route::get('book/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::post('book/update', [BookController::class, 'update'])->name('books.update');
    Route::post('book/inactive', [BookController::class, 'inactive'])->name('books.inactive');
    Route::post('book/active', [BookController::class, 'active'])->name('books.active');
    Route::post('book/delete', [BookController::class, 'destroy'])->name('books.destroy'); 


    // chapter 
    Route::get('chapter/manage', [ChapterController::class, 'index'])->name('chapter.index');
    Route::get('chapter/create', [ChapterController::class, 'create'])->name('chapter.create');
    Route::post('chapter/save', [ChapterController::class, 'store'])->name('chapter.store');
    Route::get('chapter/{id}/edit', [ChapterController::class, 'edit'])->name('chapter.edit');
    Route::post('chapter/update', [ChapterController::class, 'update'])->name('chapter.update');
    Route::post('chapter/inactive', [ChapterController::class, 'inactive'])->name('chapter.inactive');
    Route::post('chapter/active', [ChapterController::class, 'active'])->name('chapter.active');
    Route::post('chapter/destroy', [ChapterController::class, 'destroy'])->name('chapter.destroy');

     // lesson 
    Route::get('lesson/manage', [LessonController::class, 'index'])->name('lesson.index');
    Route::get('lesson/create', [LessonController::class, 'create'])->name('lesson.create');
    Route::post('lesson/save', [LessonController::class, 'store'])->name('lesson.store');
    Route::get('lesson/{id}/edit', [LessonController::class, 'edit'])->name('lesson.edit');
    Route::post('lesson/update', [LessonController::class, 'update'])->name('lesson.update');
    Route::post('lesson/inactive', [LessonController::class, 'inactive'])->name('lesson.inactive');
    Route::post('lesson/active', [LessonController::class, 'active'])->name('lesson.active');
    Route::post('lesson/destroy', [LessonController::class, 'destroy'])->name('lesson.destroy');

    // book
    Route::get('success/manage', [SuccessStudentController::class, 'index'])->name('success_students.index');
    Route::get('success-student/create', [SuccessStudentController::class, 'create'])->name('success_students.create');
    Route::post('success-student/save', [SuccessStudentController::class, 'store'])->name('success_students.store');
    Route::get('success-student/{id}/edit', [SuccessStudentController::class, 'edit'])->name('success_students.edit');
    Route::post('success-student/update', [SuccessStudentController::class, 'update'])->name('success_students.update');
    Route::post('success-student/inactive', [SuccessStudentController::class, 'inactive'])->name('success_students.inactive');
    Route::post('success-student/active', [SuccessStudentController::class, 'active'])->name('success_students.active');
    Route::post('success-student/delete', [SuccessStudentController::class, 'destroy'])->name('success_students.destroy');
    Route::post('success-year-add', [SuccessStudentController::class, 'success_year'])->name('success_year.add');
});
