<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/careers', function () {
    return view('careers');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);

	Route::prefix('admin')->group(function() {
		//MenuView
		Route::get('/organization_viewer', 'Admin\Organization\OrganizationHierarchyController@OrganizationViewerView')->name('organization_viewer');
		Route::get('/organization_viewer_v2', 'Admin\Organization\OrganizationHierarchyController@OrganizationViewerViewV2')->name('organization_viewer_v2');
		Route::get('/organization_viewer_v3', 'Admin\Organization\OrganizationHierarchyController@OrganizationViewerViewV3')->name('organization_viewer_v3');
		Route::get('/organization_setup', 'Admin\Organization\OrganizationHierarchyController@OrganizationSetupView')->name('organization_setup');
		Route::get('/employee', 'Admin\Organization\OrganizationHierarchyController@EmployeeView')->name('employee');
		Route::get('/one_page_settings', 'Admin\Organization\OrganizationHierarchyController@OnePageSettingsView')->name('one_page_settings');
		Route::get('/national_holidays', 'Admin\Organization\OrganizationHierarchyController@NationalHolidaysView')->name('national_holidays');
		Route::get('/skill-list', 'Admin\Qualifications\QualificationController@SkillListView')->name('skill_list');
		Route::get('/employee-hierarchy', 'Admin\Organization\OrganizationController@EmployeeHierarchy')->name('employee_hierarchy');

		Route::get('/user-list', 'Admin\UserManagement\UserManagementController@UserListView')->name('user_list');
		Route::get('/user-role-list', 'Admin\UserManagement\UserManagementController@UserRoleListView')->name('user_role_list');
		Route::get('/job-title-list', 'Admin\Job\JobController@JobTittleListView')->name('job_title_list');
		Route::get('/employee-status-list', 'Admin\Job\JobController@EmployeeStatusListView')->name('employee_status_list');
		Route::get('/job-category-list', 'Admin\Job\JobController@JobCategoryListView')->name('job_category_list');
		Route::get('/work-shift-list', 'Admin\Job\JobController@WorkShiftListView')->name('work_shift_list');
		Route::get('/location-list', 'Admin\Organization\OrganizationController@LocationListView')->name('location_list');
		Route::get('/general-info', 'Admin\Organization\OrganizationController@GeneralInfoView')->name('general_info');
		Route::get('/skill-list', 'Admin\Qualifications\QualificationController@SkillListView')->name('skill_list');
		Route::get('/education-list', 'Admin\Qualifications\QualificationController@EducationListView')->name('education_list');
		Route::get('/document-category-list', 'Admin\Announcements\AnnouncementController@DocumentCategoryView')->name('document_category_list');
		Route::get('/audit-trail', 'Admin\AuditTrialController@AuditTrailView')->name('audit_trail');
	
		Route::get('/data-location', 'Admin\Organization\OrganizationController@locationGetData')->name('data_location');
		Route::get('/data-jobtitle', 'Admin\Job\JobController@jobtitleGetData')->name('data_jobtitle');
		Route::get('/data-jobcategory', 'Admin\Job\JobController@jobcategoryGetData')->name('data_jobcategory');
		Route::get('/data-workshift', 'Admin\Job\JobController@workshiftGetData')->name('data_workshift');
		Route::get('/data-skill', 'Admin\Qualifications\QualificationController@skillGetData')->name('data_skill');
		Route::get('/data-education', 'Admin\Qualifications\QualificationController@educationGetData')->name('data_education');
		Route::get('/data-user', 'Admin\UserManagement\UserManagementController@GetDataUser')->name('data_user');
	
		Route::post('/save-location', 'Admin\Organization\OrganizationController@saveLocation')->name('save_location');
		Route::post('/save-jobtitle', 'Admin\Job\JobController@saveJobTitle')->name('save_jobtitle');
		Route::post('/save-jobcategory', 'Admin\Job\JobController@saveJobCategory')->name('save_jobcategory');
		Route::post('/save-workshift', 'Admin\Job\JobController@saveWorkShift')->name('save_workshift');
		Route::post('/update-jobtitle', 'Admin\Job\JobController@jobTitleUpdateStatus')->name('update_jobtitle');
		Route::post('/update-jobcategory', 'Admin\Job\JobController@jobCategoryUpdateStatus')->name('update_jobcategory');
		Route::post('/update-workshift', 'Admin\Job\JobController@workShiftUpdateStatus')->name('update_workshift');
		Route::post('/update-location', 'Admin\Organization\OrganizationController@locationUpdateStatus')->name('update_location');
		Route::post('/update-education', 'Admin\Qualifications\QualificationController@educationUpdateStatus')->name('update_education');
		Route::post('/save-skill', 'Admin\Qualifications\QualificationController@saveSkill')->name('save_skill');
		Route::post('/save-education', 'Admin\Qualifications\QualificationController@saveEducation')->name('save_education');
		Route::post('/save-new-user', 'Admin\UserManagement\UserManagementController@createUser')->name('save_new_user');
		Route::post('/save-emp', 'Admin\Organization\OrganizationController@saveHierarchy')->name('save_hierarchy');
	});
	
	
	Route::prefix('pim')->group(function() {
		Route::get('/add-employee', 'PIM\Employee\EmployeeController@AddEmployee')->name('add_employee');
		Route::get('/list-employee', 'PIM\Employee\EmployeeController@ListView')->name('list_employee');
		Route::get('/view-employee/{id}', 'PIM\Employee\EmployeeController@ViewEmp')->name('view_employee');
		Route::get('/data-employee', 'PIM\Employee\EmployeeController@employeeGetData')->name('data_employee');
		Route::get('/data-employee', 'PIM\Employee\EmployeeController@employeeGetDataHierarchy')->name('data_employee_hierarchy');
		Route::get('/data-employeestatus', 'PIM\Employee\EmployeeController@employeestatusGetData')->name('data_employeestatus');
		Route::get('/data-employeeexZp/{id}', 'PIM\Employee\EmployeeController@employeeexpGetData')->name('data_employeeexp');
		Route::get('/data-employeeedu/{id}', 'PIM\Employee\EmployeeController@employeeeduGetData')->name('data_employeeedu');
		Route::get('/data-employeeskill/{id}', 'PIM\Employee\EmployeeController@employeeskillGetData')->name('data_employeeskill');
		Route::get('/data-employeefam/{id}', 'PIM\Employee\EmployeeController@employeefamGetData')->name('data_employeefam');
		Route::get('/data-employeeacc/{id}', 'PIM\Employee\EmployeeController@employeeaccGetData')->name('data_employeeacc');
	
		Route::post('/save-employee', 'PIM\Employee\EmployeeController@saveEmployee')->name('save_employee');
		Route::post('/save-employeestatus', 'PIM\Employee\EmployeeController@saveEmployeeStatus')->name('save_employeestatus');
		Route::post('/update-employeestatus', 'PIM\Employee\EmployeeController@employeeStatusUpdateStatus')->name('update_employeestatus');
		Route::post('/save-employeeexp', 'PIM\Employee\EmployeeController@saveEmployeeExp')->name('save_employeeexp');
		Route::post('/save-employeeedu', 'PIM\Employee\EmployeeController@saveEmployeeEdu')->name('save_employeeedu');
		Route::post('/save-employeeskill', 'PIM\Employee\EmployeeController@saveEmployeeSkill')->name('save_employeeskill');
		Route::post('/save-employeefam', 'PIM\Employee\EmployeeController@saveEmployeeFam')->name('save_employeefam');
		Route::post('/save-employeeacc', 'PIM\Employee\EmployeeController@saveEmployeeAcc')->name('save_employeeacc');
		Route::post('/save-employeecontact', 'PIM\Employee\EmployeeController@saveContactEmp')->name('save_employeecontact');
	
		Route::get('/del-employeeexp/{id}', 'PIM\Employee\EmployeeController@deleteEmployeeExp')->name('del_employeeexp');
		Route::get('/del-employeeedu/{id}', 'PIM\Employee\EmployeeController@deleteEmployeeEdu')->name('del_employeeedu');
		Route::get('/del-employeeskill/{id}', 'PIM\Employee\EmployeeController@deleteEmployeeSkill')->name('del_employeeskill');
		Route::get('/del-employeefam/{id}', 'PIM\Employee\EmployeeController@deleteEmployeeFam')->name('del_employeefam');
		Route::get('/del-employeeacc/{id}', 'PIM\Employee\EmployeeController@deleteEmployeeAcc')->name('del_employeeacc');
		Route::get('/test', 'PIM\Employee\EmployeeController@test')->name('test');
	
		Route::post('/update-personal', 'PIM\Employee\EmployeeController@personalUpdate')->name('update_personal');
		Route::post('/update-job', 'PIM\Employee\EmployeeController@jobUpdate')->name('update_job');
		Route::post('/update-img', 'PIM\Employee\EmployeeController@imgUpdate')->name('update_img');
	
	
	});
	Route::prefix('myinfo')->group(function() {
		Route::get('/view', 'MyInfo\MyInfoController@MyInfoView')->name('my_info');
	
	});
	
	Route::prefix('development')->group(function() {
		Route::get('/box-matrix', 'Development\BoxMatrix\MatrixController@BoxMatrixView')->name('box_matrix');
	
	});
	
	Route::prefix('leave')->group(function() {
		

		Route::get('/leave-calendar', 'Leave\LeaveCalendar@LeaveCalendarView')->name('leave_calendar');
		Route::get('/leave-type-list', 'Leave\Configuration\ConfigurationController@LeaveTypeListView')->name('leave_type');
		Route::get('/holiday', 'Leave\Configuration\ConfigurationController@HolidayListView')->name('holiday_list');
		Route::get('/delete-holiday/{id}', 'Leave\Configuration\ConfigurationController@deleteholiday')->name('delete_holiday');
		Route::get('/my-leave', 'Leave\Employee\LeaveController@MyLeaveView')->name('my_leave');
		Route::get('/my-leave-report', 'Leave\Employee\LeaveController@MyLeaveReportView')->name('my_leave_report');
		Route::get('/leave-report', 'Leave\Employee\LeaveController@LeaveReportView')->name('leave_report');
		Route::get('/list-leave', 'Leave\Employee\LeaveController@listLeaveView')->name('list_leave');
		Route::get('/assign-leave', 'Leave\Employee\LeaveController@assignLeaveView')->name('assign_leave');
		Route::get('/bulk-assign-leave', 'Leave\Employee\LeaveController@bulkassignLeaveView')->name('bulk_leave');
		Route::get('/add-entitlement', 'Leave\Entitlements\EntitlementController@addEntitlementView')->name('add_entitlement');
		Route::get('/add-entitlement-contract', 'Leave\Entitlements\EntitlementController@addEntitlementContractView')->name('add_entitlement_contract');
		Route::get('/bulk-add-entitlement', 'Leave\Entitlements\EntitlementController@bulkaddEntitlementView')->name('bulk_add_entitlement');
		Route::get('/list-entitlement', 'Leave\Entitlements\EntitlementController@listEntitlementView')->name('list_entitlement');
		Route::get('/get', 'Leave\Entitlements\EntitlementController@getEmployeebyContract')->name('get');
		Route::post('/save-entitlement-contract', 'Leave\Entitlements\EntitlementController@saveEntitlementContract')->name('save_entitlement_contract');
	
	
		Route::get('/data-leave-type', 'Leave\Configuration\ConfigurationController@leavetypeGetData')->name('data_leave_type');
		Route::get('/data-holiday', 'Leave\Configuration\ConfigurationController@holidayGetData')->name('data_holiday');
		Route::get('/leave-type/{id}', 'Leave\Configuration\ConfigurationController@leavetypeID')->name('leave_type');
		Route::get('/data-my-leave', 'Leave\Employee\LeaveController@myleaveGetData')->name('data_my_leave');
		Route::get('/data-my-leave-report', 'Leave\Employee\LeaveController@myleaveReportGetData')->name('data_my_leave_report');
		Route::get('/data-leave-report', 'Leave\Employee\LeaveController@leaveReportGetData')->name('data_leave_report');
		Route::get('/data-leave', 'Leave\Employee\LeaveController@leaveGetData')->name('data_leave');
		Route::get('/data-entitlement', 'Leave\Entitlements\EntitlementController@entitlementGetData')->name('data_entitlement');
	
	
		Route::post('/save-leave-type', 'Leave\Configuration\ConfigurationController@saveLeaveType')->name('save_leave_type');
		Route::post('/save-holiday', 'Leave\Configuration\ConfigurationController@saveHoliday')->name('save_holiday');
		Route::post('/update-leave-type', 'Leave\Configuration\ConfigurationController@updateType')->name('update_leave_type');
		Route::post('/save-my-leave', 'Leave\Employee\LeaveController@saveMyLeave')->name('save_my_leave');
		Route::post('/save-leave', 'Leave\Employee\LeaveController@saveAssignLeave')->name('save_assign_leave');
		Route::post('/save-entitlement', 'Leave\Entitlements\EntitlementController@saveEntitlement')->name('save_entitlement');
		Route::post('/save-bulk-entitlement', 'Leave\Entitlements\EntitlementController@saveBulkEntitlement')->name('save_bulk_entitlement');

		Route::get('/generate-holiday', 'Leave\Configuration\ConfigurationController@generateHoliday')->name('generate_holiday');
	
	});
	
	Route::prefix('time')->group(function() {
		Route::get('/my-timesheets', 'Time\TimeSheets\TimeSheetController@MyTImeSheetsView')->name('my_time_sheets');
		Route::get('/add-punch', 'Time\Attendance\AttendanceController@addPunchView')->name('add_punch');
		Route::get('/employee-record', 'Time\Attendance\AttendanceController@listEmployeeRecordView')->name('list_employee_record');
		Route::get('/testing', 'Time\Attendance\AttendanceController@testing')->name('testing');
		Route::get('/my-record', 'Time\Attendance\AttendanceController@myRecordView')->name('my_record_time');
	
		Route::post('/save-punch', 'Time\Attendance\AttendanceController@savePunch')->name('save_punch');

		Route::get('/my-record-data', 'Time\Attendance\AttendanceController@myRecordData')->name('my_record_data');
	
	});
	Route::prefix('recruitment')->group(function() {
		Route::get('/vacancies-list', 'Recruitment\RecruitmentController@VacanciesView')->name('vacancies_view');
		Route::get('/vacancies-data', 'Recruitment\RecruitmentController@vacancyData')->name('vacancies_data');
		Route::get('/candidate-data', 'Recruitment\RecruitmentController@candidateData')->name('candidate_data');
		Route::get('/candidate-list', 'Recruitment\RecruitmentController@CandidateView')->name('candidate_view');
		Route::get('/add-new-candidate', 'Recruitment\RecruitmentController@AddCandidateView')->name('add_candidate');
		Route::get('/view-candidate/{id}', 'Recruitment\RecruitmentController@ViewCandidate')->name('view_candidate');
		Route::get('/resume/{id}', 'Recruitment\RecruitmentController@resumedownload')->name('resume');
		Route::get('/candidate-detail-data', 'Recruitment\RecruitmentController@candidatePerformData')->name('candidate_perform');

		Route::post('/save-vacancy', 'Recruitment\RecruitmentController@saveVacancy')->name('save_vacancy');
		Route::post('/save-candidate', 'Recruitment\RecruitmentController@saveCandidate')->name('save_candidate');
		Route::post('/update-status', 'Recruitment\RecruitmentController@updateStatus')->name('update_status');
	;
	
	});

	Route::prefix('discipline')->group(function() {
		Route::get('/list', 'Discipline\DisciplineController@DisciplineListView')->name('discpline_list');
		Route::get('/my-action', 'Discipline\DisciplineController@MyActionListView')->name('my_action_list');
		Route::get('/data', 'Discipline\DisciplineController@disciplineData')->name('discipline_data');
		Route::get('/action-data', 'Discipline\DisciplineController@actionData')->name('action_data');
		Route::get('/action-data/{id}', 'Discipline\DisciplineController@actionDataById')->name('action_data_id');
		Route::get('/config-action', 'Discipline\DisciplineController@ConfigDisciplineActionView')->name('config_action');
		Route::get('/config-action-data', 'Discipline\DisciplineController@actionConfigData')->name('config_action_data');

		Route::post('/save', 'Discipline\DisciplineController@saveDiscipline')->name('save_discipline');
		Route::post('/update-action', 'Discipline\DisciplineController@updateAction')->name('update_action');
		Route::post('/save-action', 'Discipline\DisciplineController@saveDisciplineAction')->name('save_discipline_action');

		
	
	});
	Route::prefix('training')->group(function() {
		Route::get('/course-list', 'Training\TrainingController@CourseListView')->name('course_list');
		Route::get('/session-list', 'Training\TrainingController@SessionListView')->name('session_list');
		Route::get('/participant-session', 'Training\TrainingController@ParticipantSessionView')->name('participant_list');
		Route::get('/session-view/{id}', 'Training\TrainingController@ViewSession')->name('session_view');
		Route::get('/participant-view/{id}', 'Training\TrainingController@ViewSession')->name('participant_view');
		Route::get('/session-data', 'Training\TrainingController@sessionData')->name('session_data');
		Route::get('/participant-data', 'Training\TrainingController@participantData')->name('participant_data');
		Route::get('/course-data', 'Training\TrainingController@courseData')->name('course_data');

		Route::post('/save-session', 'Training\TrainingController@saveSession')->name('save_session');
		Route::post('/save-course', 'Training\TrainingController@saveCourse')->name('save_course');
		Route::post('/update-status', 'Training\TrainingController@updateStatus')->name('updateStatus_course');
	
	});
	
	Route::prefix('socialnetwork')->group(function() {
		Route::get('/dashboard', 'SocialNetwork\DashboardController@dashboard')->name('social_dashboard');
	
	});

	Route::prefix('performance')->group(function() {
		Route::get('/manage-tracker', 'Performance\EmployeeTrackerController@ManageTrackerView')->name('manage_tracker');
		Route::get('/tracker-list', 'Performance\EmployeeTrackerController@TrackerListView')->name('tracker_list');
		Route::get('/my-tracker-list', 'Performance\EmployeeTrackerController@MyTrackerListView')->name('tracker_list');
		Route::get('/tracker-view/{id}', 'Performance\EmployeeTrackerController@ViewTrackerView')->name('tracker_view');
		Route::get('/my-tracker-view/{id}', 'Performance\EmployeeTrackerController@ViewMyTrackerView')->name('my_tracker_view');
		Route::get('/tracker-viewall/{id}', 'Performance\EmployeeTrackerController@ViewTrackerAllView')->name('tracker_view_all');
		Route::get('/empdata', 'Performance\EmployeeTrackerController@employeeData')->name('emp_data');
		Route::get('/tracker-data', 'Performance\EmployeeTrackerController@trackerData')->name('tracker_data');
		Route::get('/my-tracker-data', 'Performance\EmployeeTrackerController@mytrackerData')->name('my_tracker_data');
		Route::get('/tracker-dataall', 'Performance\EmployeeTrackerController@trackerDataAll')->name('tracker_data_all');
		Route::get('/tracker-data-view', 'Performance\EmployeeTrackerController@viewtrackerData')->name('tracker_data_view');

		Route::post('/save-tracker', 'Performance\EmployeeTrackerController@saveTracker')->name('save_tracker');
		Route::post('/save-tracker-log', 'Performance\EmployeeTrackerController@saveLogTracker')->name('save_tracker_log');
	
	});

	Route::prefix('expense')->group(function() {
		Route::get('/config', 'Expense\ExpenseController@ExpenseTypeView')->name('expense_config');
		Route::get('/add-new', 'Expense\ExpenseController@AddNewExpenseView')->name('add_expense');
		Route::get('/config-data', 'Expense\ExpenseController@expenseconfigData')->name('expense_config_data');


		Route::post('/save-config', 'Expense\ExpenseController@saveExpenseConfig')->name('expense_save_config');
		Route::post('/update-config', 'Expense\ExpenseController@updateStatus')->name('expense_update_config');
	
	});
});

