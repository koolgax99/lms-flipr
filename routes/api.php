<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});


Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', ['uses'=>'UserController@index','as'=>'users.index']);
    Route::post('users/store',['uses'=>'UserController@store','as'=>'users.store']);
    Route::get('users/{id}/edit',['uses'=>'UserController@edit','as'=>'users.edit']);
    Route::put('users/{id}/update',['uses'=>'UserController@update','as'=>'users.update']);
    Route::get('users/{id}', 'UserController@show');

    // Roles
    Route::get('roles',['uses'=>'RolesController@index','as'=>'roles.index']);
    Route::post('roles/store',['uses'=>'RolesController@store','as'=>'roles.store']);
    Route::get('roles/{id}/edit',['uses'=>'RolesController@edit','as'=>'roles.edit']);
    Route::put('roles/{id}/update',['uses'=>'RolesController@update','as'=>'roles.update']);

    // Departments
    Route::get('departments',['uses'=>'DepartmentsController@index','as'=>'departments.index']);
    Route::post('departments/store',['uses'=>'DepartmentsController@store','as'=>'departments.store']);
    Route::get('departments/{id}/edit',['uses'=>'DepartmentsController@edit','as'=>'departments.edit']);
    Route::put('departments/{id}/update',['uses'=>'DepartmentsController@update','as'=>'departments.update']);

    // Classrooms
    Route::get('classrooms',['uses'=>'ClassroomsController@index','as'=>'classrooms.index']);
    Route::post('classrooms/store',['uses'=>'ClassroomsController@store','as'=>'classrooms.store']);
    Route::get('classrooms/{id}/edit',['uses'=>'ClassroomsController@edit','as'=>'classrooms.edit']);
    Route::put('classrooms/{id}/update',['uses'=>'ClassroomsController@update','as'=>'classrooms.update']);

    // Get All Teachers
    Route::get('getTeachers',['uses'=>'UserController@getTeachers','as'=>'getTeachers']);

    // Get All Students
    Route::get('getStudents',['uses'=>'UserController@getStudents','as'=>'getStudents']);

    // Batches
    Route::get('batches',['uses'=>'BatchesController@index','as'=>'batches.index']);
    Route::post('batches/store',['uses'=>'BatchesController@store','as'=>'batches.store']);
    Route::get('batches/{id}/edit',['uses'=>'BatchesController@edit','as'=>'batches.edit']);
    Route::put('batches/{id}/update',['uses'=>'BatchesController@update','as'=>'batches.update']);

    // Subjects
    Route::get('subjects',['uses'=>'SubjectsController@index','as'=>'subjects.index']);
    Route::post('subjects/store',['uses'=>'SubjectsController@store','as'=>'subjects.store']);
    Route::get('subjects/{id}/edit',['uses'=>'SubjectsController@edit','as'=>'subjects.edit']);
    Route::put('subjects/{id}/update',['uses'=>'SubjectsController@update','as'=>'subjects.update']);


    // Department Teachers (to be removed)
    Route::get('department_teachers',['uses'=>'Department_TeachersController@index','as'=>'department_teachers.index']);
    Route::post('department_teachers/store',['uses'=>'Department_TeachersController@store','as'=>'department_teachers.store']);
    Route::get('department_teachers/{id}/edit',['uses'=>'Department_TeachersController@edit','as'=>'department_teachers.edit']);
    Route::put('department_teachers/{id}/update',['uses'=>'Department_TeachersController@update','as'=>'department_teachers.update']);

    // Classroom Teachers
    Route::get('classroom_teachers',['uses'=>'Classroom_TeachersController@index','as'=>'classroom_teachers.index']);
    Route::get('classroom/{id}/teachers',['uses'=>'Classroom_TeachersController@classroom_index','as'=>'classroom_teachers.classroom_index']);
    Route::post('classroom/{classroom_id}/teachers/store',['uses'=>'Classroom_TeachersController@store','as'=>'classroom_teachers.store']);
    Route::get('classroom/{classroom_id}/teachers/{id}/edit',['uses'=>'Classroom_TeachersController@edit','as'=>'classroom_teachers.edit']);
    Route::put('classroom/{classroom_id}/teachers/{id}/update',['uses'=>'Classroom_TeachersController@update','as'=>'classroom_teachers.update']);

    // Get All Classrooms for a particular Teacher
    Route::get('teachers/classrooms',['uses'=>'ClassroomsController@getTeacherClassrooms','as'=>'classroom_teachers.get_classrooms']);

    // Get All Batches for a particular Teacher
    Route::get('teachers/batches',['uses'=>'BatchesController@getTeacherBatches','as'=>'batches_teachers.get_batches']);

    // Get All Batches for a particular Classroom
    Route::get('classrooms/{classroom_id}/batches',['uses'=>'ClassroomsController@getClassroomBatches','as'=>'classrooms.get_batches']);

    // Get All Students for a particular Batch
    Route::get('batches/{batch_id}/students',['uses'=>'BatchesController@getBatchStudents','as'=>'batches.get_students']);

    // Get All Students for a particular Classroom
    Route::get('classrooms/{classroom_id}/students',['uses'=>'ClassroomsController@getClassroomStudents','as'=>'classrooms.get_students']);

    // Get All Subjects for a particular Batch
    Route::get('batches/{batch_id}/subjects',['uses'=>'SubjectsController@getTeacherBatchSubjects','as'=>'subjects.batch_subjects']);

    // Get All Subjects for a particular Classroom
    Route::get('classrooms/{classroom_id}/subjects',['uses'=>'SubjectsController@getTeacherClassroomSubjects','as'=>'subjects.classroom_subjects']);

    // Get All Classrooms for a particular Department
    Route::get('departments/{classroom_id}/classrooms',['uses'=>'ClassroomsController@getDepartmentClassrooms','as'=>'classrooms.get_classrooms']);
    // Check Student Assignment Submission
    Route::get('assignments/{assignment_id}/submission',['uses'=>'Assignment_SubmissionsController@checkStudentSubmission','as'=>'assignment.check_submission']);

    // Check whether Student is allowed to add answer for a particular assignment
    Route::get('assignments/{assignment_id}/add-permission',['uses'=>'AssignmentsController@checkStudentAddAssignmentSubmissionPermission','as'=>'assignment.add_answer_permission']);

    Route::get('getUserRole',['uses'=>'AuthController@getUserRole','as'=>'user.get_role']);

    // Get User
    Route::get('getUser/{id}',['uses'=>'UserController@view','as'=>'user.get_user']);

    // Batch Teachers
    Route::get('batches/{batch_id}/teachers',['uses'=>'Batch_TeachersController@index','as'=>'batch_teachers.index']);
    Route::post('batches/{batch_id}/teachers/store',['uses'=>'Batch_TeachersController@store','as'=>'batch_teachers.store']);
    Route::get('batches/{batch_id}/teachers/{id}/edit',['uses'=>'Batch_TeachersController@edit','as'=>'batch_teachers.edit']);
    Route::put('batches/{batch_id}/teachers/{id}/update',['uses'=>'Batch_TeachersController@update','as'=>'batch_teachers.update']);

    // Assignments
    Route::get('assignments',['uses'=>'AssignmentsController@index','as'=>'assignments.index']);
    Route::post('assignments/store',['uses'=>'AssignmentsController@store','as'=>'assignments.store']);
    Route::get('assignments/{id}/edit',['uses'=>'AssignmentsController@edit','as'=>'assignments.edit']);
    Route::put('assignments/{id}/update',['uses'=>'AssignmentsController@update','as'=>'assignments.update']);
    Route::get('assignments/{id}/view',['uses'=>'AssignmentsController@view','as'=>'assignments.view']);

    // Assignment Submissions
    Route::get('assignments/{assignment_id}/submissions',['uses'=>'Assignment_SubmissionsController@index','as'=>'assignment_submissions.index']);
    Route::post('assignments/{assignment_id}/submissions/store',['uses'=>'Assignment_SubmissionsController@store','as'=>'assignment_submissions.store']);
    Route::get('assignments/{assignment_id}/submissions/{id}/edit',['uses'=>'Assignment_SubmissionsController@edit','as'=>'assignment_submissions.edit']);
    Route::get('assignments/{assignment_id}/submissions/{id}/view',['uses'=>'Assignment_SubmissionsController@view','as'=>'assignment_submissions.view']);
    Route::put('assignments/{assignment_id}/submissions/{id}/update',['uses'=>'Assignment_SubmissionsController@update','as'=>'assignment_submissions.update']);
    Route::put('assignments/{assignment_id}/submissions/{id}/storeOrUpdateMarks',['uses'=>'Assignment_SubmissionsController@storeOrUpdateMarks','as'=>'assignment_submissions.store_or_update_marks']);

    // Line Chart
    Route::get('assignments/{assignment_id}/all-students-one-assignment',['uses'=>'Assignment_SubmissionsController@all_students_one_assignment']);
    Route::get('assignments/{student_id}/one-student-all-assignments',['uses'=>'Assignment_SubmissionsController@one_student_all_assignments']);


    // Attendance
    Route::get('attendance',['uses'=>'AttendanceController@index','as'=>'attendance.index']);
    Route::post('attendance/store',['uses'=>'AttendanceController@store_attendance','as'=>'attendance.store_attendance']);
    Route::post('attendance/{attendance_id}/status/store',['uses'=>'AttendanceController@store_daily_attendance','as'=>'attendance.store_daily_attendance']);
    Route::get('attendance/{attendance_id}/view',['uses'=>'AttendanceController@view','as'=>'attendance.view_attendance']);
    Route::get('attendance/{attendance_id}/status',['uses'=>'AttendanceController@status','as'=>'attendance.view_attendance_status']);

    // Study Material
    Route::get('study-materials',['uses'=>'StudyMaterialController@index','as'=>'study-material.index']);
    Route::post('study-materials/store',['uses'=>'StudyMaterialController@store','as'=>'study-material.store']);
    Route::get('study-materials/{id}/edit',['uses'=>'StudyMaterialController@edit','as'=>'study-material.edit']);
    Route::put('study-materials/{id}/update',['uses'=>'StudyMaterialController@update','as'=>'study-material.update']);

    //Notices
    Route::get('notices',['uses'=>'NoticesController@index','as'=>'notices.index']);
    Route::post('notices/store',['uses'=>'NoticesController@store','as'=>'notices.store']);
    Route::get('notices/{id}/edit',['uses'=>'NoticesController@edit','as'=>'notices.edit']);
    Route::put('notices/{id}/update',['uses'=>'NoticesController@update','as'=>'notices.update']);
    Route::get('notices/{id}/view',['uses'=>'NoticesController@view','as'=>'notices.view']);

    //Holidays
    Route::get('holidays',['uses'=>'HolidaysController@index','as'=>'holidays.index']);
    Route::post('holidays/store',['uses'=>'HolidaysController@store','as'=>'holidays.store']);
    Route::get('holidays/{id}/edit',['uses'=>'HolidaysController@edit','as'=>'holidays.edit']);
    Route::put('holidays/{id}/update',['uses'=>'HolidaysController@update','as'=>'holidays.update']);

    //Classroom_timetable
    Route::get('classroom_timetable',['uses'=>'Classroom_TimetableController@index','as'=>'classroom_timetable.index']);
    Route::post('classroom_timetable/store',['uses'=>'Classroom_TimetableController@store','as'=>'classroom_timetable.store']);
    Route::get('classroom_timetable/{id}/edit',['uses'=>'Classroom_TimetableController@edit','as'=>'classroom_timetable.edit']);
    Route::put('classroom_timetable/{id}/update',['uses'=>'Classroom_TimetableController@update','as'=>'classroom_timetable.update']);
});
