<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Organization\Http\Controllers'], function()
{
	Route::get('/branch/auto/get_branch_types', 'AutoCompleteController@getBranchTypes'); 
	Route::get('/branch/auto/get_branchs', 'AutoCompleteController@getBranchs'); 
	Route::get('/branch/auto/get_districts', 'AutoCompleteController@getDistricts'); 
	Route::get('/branch/auto/get_post_offices', 'AutoCompleteController@getPostOffices'); 
	Route::get('/branch/auto/get_branch_district', 'AutoCompleteController@getDistrictOfBranch');
	Route::get('/branch/auto/get_branch_post_office', 'AutoCompleteController@getPostOfficeOfBranch');
	Route::get('/branch/auto/get_branch_branch_type', 'AutoCompleteController@getBranchTypeOfBranch');

	Route::get('/department/auto/get_department_types', 'AutoCompleteController@getDepartmentTypes');
	Route::get('/department/auto/get_department/department_type', 'AutoCompleteController@getDepartmentTypeOfDepartment');
	Route::get('/department/auto/get_department/branch', 'AutoCompleteController@getBranchOfDepartment');




	Route::get('/district/get_all_districts', 'DistrictController@getAllDistricts'); 
	Route::resource('district', 'DistrictController');

	Route::get('/post_office/auto/get_district', 'AutoCompleteController@getDistrictOfPostOffice'); 
	Route::get('/post_office/get_all_post_offices', 'PostOfficeController@getAllPostOffices'); 
	Route::resource('post_office', 'PostOfficeController');

	Route::get('/branch_type/get_all_branch_types', 'BranchTypeController@getAllBranchTypes'); 
	Route::resource('branch_type', 'BranchTypeController');

	Route::get('/branch/get_all_branches', 'BranchController@getAllBranches'); 
	Route::resource('branch', 'BranchController');

	Route::get('/department_type/get_all_department_types', 'DepartmentTypeController@getAllDepartmentTypes');
	Route::resource('department_type', 'DepartmentTypeController');

	Route::get('/department/get_all_departments', 'DepartmentController@getAllDepartments');
	Route::resource('department', 'DepartmentController');

	Route::get('/designation/get_all_designations', 'DesignationController@getAllDesignations');
	Route::resource('designation', 'DesignationController');

	Route::get('/work_shift/get_all_work_shifts', 'WorkShiftController@getAllWorkShifts');
	Route::resource('/work_shift', 'WorkShiftController');

	Route::get('/salary_head/get_all_salary_heads', 'SalaryHeadController@getAllSalaryHeads');
	Route::resource('/salary_head', 'SalaryHeadController');

	Route::get('/salary_grade/get_all_salary_grades', 'SalaryGradeController@getAllSalaryGrades');
	Route::resource('/salary_grade', 'SalaryGradeController');


	Route::get('/week_holiday/get_all_week_holidays', 'WeekHolidayController@getAllWeekHolidays');

	// Route::resource('/week_holiday', 'WeekHolidayController');

	Route::resource('/week_holiday', 'WeekHolidayController', ['parameters' => [
    	'week_holiday' => 'week_holiday_master'
	]]);

	Route::get('testmultiple', function(){
		$salary_grade = Modules\Organization\Entities\SalaryGradeMaster::find(1);
		dd([
			array('amount' => 2000, 'salary_head_id' => 2),
			array('amount' => 3000, 'salary_head_id' => 3),
		]);
		
		$salary_grade->salary_grade_info()->createMany([
			array('amount' => 2000, 'salary_head_id' => 2),
			array('amount' => 3000, 'salary_head_id' => 3),
		]);
		dd($salary_grade);
	});
});
