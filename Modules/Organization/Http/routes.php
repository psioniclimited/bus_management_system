<?php

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Organization\Http\Controllers'], function()
{
	Route::get('/branch/auto/get_branch_types', 'AutoCompleteController@getBranchTypes'); 
	Route::get('/branch/auto/get_districts', 'AutoCompleteController@getDistricts'); 
	Route::get('/branch/auto/get_post_offices', 'AutoCompleteController@getPostOffices'); 
	Route::get('/branch/auto/get_branch_district', 'AutoCompleteController@getDistrictOfBranch');
	Route::get('/branch/auto/get_branch_post_office', 'AutoCompleteController@getPostOfficeOfBranch');
	Route::get('/branch/auto/get_branch_branch_type', 'AutoCompleteController@getBranchTypeOfBranch');

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

  


});
