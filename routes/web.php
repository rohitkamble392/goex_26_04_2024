<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\addpolicyController;
use App\Http\Controllers\addapplicationController;
use App\Http\Controllers\adddepartmentController;
use App\Http\Controllers\addemployeeController;
use App\Http\Controllers\RetailerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\myroleController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\distributorController;
use App\Http\Controllers\superstokistController;

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
Route::get('/', function () { return view('home'); });


Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('register', [RegisterController::class,'register']);

Route::get('password/forget',  function () { 
	return view('pages.forgot-password'); 
})->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');


Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', [LoginController::class,'logout']);
	Route::get('/clear-cache', [HomeController::class,'clearCache']);

	// dashboard route  
	Route::get('/dashboard', function () { 
		return view('pages.dashboard'); 
	})->name('dashboard');

	//only those have manage_user permission will get access
	Route::group(['middleware' => 'can:manage_user'], function(){
	Route::get('/users', [UserController::class,'index']);
	Route::get('/user/get-list', [UserController::class,'getUserList']);
		Route::get('/user/create', [UserController::class,'create']);
		Route::post('/user/create', [UserController::class,'store'])->name('create-user');
		Route::get('/user/{id}', [UserController::class,'edit']);
		Route::post('/user/update', [UserController::class,'update']);
		Route::get('/user/delete/{id}', [UserController::class,'delete']);
	});

	//only those have manage_role permission will get access
	Route::group(['middleware' => 'can:manage_role|manage_user'], function(){
		Route::get('/roles', [RolesController::class,'index']);
		Route::get('/role/get-list', [RolesController::class,'getRoleList']);
		Route::post('/role/create', [RolesController::class,'create']);
		Route::get('/role/edit/{id}', [RolesController::class,'edit']);
		Route::post('/role/update', [RolesController::class,'update']);
		Route::get('/role/delete/{id}', [RolesController::class,'delete']);
	});


	//only those have manage_permission permission will get access
	Route::group(['middleware' => 'can:manage_permission|manage_user'], function(){
		Route::get('/permission', [PermissionController::class,'index']);
		Route::get('/permission/get-list', [PermissionController::class,'getPermissionList']);
		Route::post('/permission/create', [PermissionController::class,'create']);
		Route::get('/permission/update', [PermissionController::class,'update']);
		Route::get('/permission/delete/{id}', [PermissionController::class,'delete']);
	});

	// get permissions
	Route::get('get-role-permissions-badge', [PermissionController::class,'getPermissionBadgeByRole']);


	// permission examples
    Route::get('/permission-example', function () {
    	return view('permission-example'); 
    });
    // API Documentation
    Route::get('/rest-api', function () { return view('api'); });
    // Editable Datatable
	Route::get('/table-datatable-edit', function () { 
		return view('pages.datatable-editable'); 
	});

    // Themekit demo pages
	Route::get('/calendar', function () { return view('pages.calendar'); });
	Route::get('/charts-amcharts', function () { return view('pages.charts-amcharts'); });
	Route::get('/charts-chartist', function () { return view('pages.charts-chartist'); });
	Route::get('/charts-flot', function () { return view('pages.charts-flot'); });
	Route::get('/charts-knob', function () { return view('pages.charts-knob'); });
	Route::get('/forgot-password', function () { return view('pages.forgot-password'); });
	Route::get('/form-addon', function () { return view('pages.form-addon'); });

	Route::get('/form-advance', function () { return view('pages.form-advance'); });
	Route::get('/form-components', function () { return view('pages.form-components'); });
	Route::get('/form-picker', function () { return view('pages.form-picker'); });
	Route::get('/invoice', function () { return view('pages.invoice'); });
	Route::get('/layout-edit-item', function () { return view('pages.layout-edit-item'); });
	Route::get('/layouts', function () { return view('pages.layouts'); });

	Route::get('/navbar', function () { return view('pages.navbar'); });
	Route::get('/profile', function () { return view('pages.profile'); });
	Route::get('/project', function () { return view('pages.project'); });
	Route::get('/view', function () { return view('pages.view'); });

	Route::get('/table-bootstrap', function () { return view('pages.table-bootstrap'); });
	Route::get('/table-datatable', function () { return view('pages.table-datatable'); });
	Route::get('/taskboard', function () { return view('pages.taskboard'); });
	Route::get('/widget-chart', function () { return view('pages.widget-chart'); });
	Route::get('/widget-data', function () { return view('pages.widget-data'); });
	Route::get('/widget-statistic', function () { return view('pages.widget-statistic'); });
	Route::get('/widgets', function () { return view('pages.widgets'); });

	// themekit ui pages
	Route::get('/alerts', function () { return view('pages.ui.alerts'); });
	Route::get('/badges', function () { return view('pages.ui.badges'); });
	Route::get('/buttons', function () { return view('pages.ui.buttons'); });
	Route::get('/cards', function () { return view('pages.ui.cards'); });
	Route::get('/carousel', function () { return view('pages.ui.carousel'); });
	Route::get('/icons', function () { return view('pages.ui.icons'); });
	Route::get('/modals', function () { return view('pages.ui.modals'); });
	Route::get('/navigation', function () { return view('pages.ui.navigation'); });
	Route::get('/notifications', function () { return view('pages.ui.notifications'); });
	Route::get('/range-slider', function () { return view('pages.ui.range-slider'); });
	Route::get('/rating', function () { return view('pages.ui.rating'); });
	Route::get('/session-timeout', function () { return view('pages.ui.session-timeout'); });
	Route::get('/pricing', function () { return view('pages.pricing'); });

	// new inventory routes
	Route::get('/inventory', function () { return view('inventory.dashboard'); });
	Route::get('/pos', function () { return view('inventory.pos'); });
	Route::get('/products', function () { return view('inventory.product.list'); });
	Route::get('/products/create', function () { return view('inventory.product.create'); });  
	Route::get('/categories', function () { return view('inventory.category.index'); }); 
	Route::get('/sales', function () { return view('inventory.sale.list'); });
	Route::get('/sales/create', function () { return view('inventory.sale.create'); }); 
	Route::get('/purchases', function () { return view('inventory.purchase.list'); });
	Route::get('/purchases/create', function () { return view('inventory.purchase.create'); }); 
	Route::get('/customers', function () { return view('inventory.people.customers'); }); 
	Route::get('/suppliers', function () { return view('inventory.people.suppliers'); }); 
	// SAMPLE PROJECT START

	// SUPER ADMIN START
	Route::get('/superadmin-dashboard', function () {return view('pages.super-admin.dashboard-superadmin');})->name('dashboard-superadmin');
	// SUPER ADMIN END

	// COMPANY ROUTES START
	Route::get('/company-dashboard', function () {return view('pages.dashboard-company');})->name('dashboard-company');
	Route::get('/company-details', function () {return view('pages.company-details');})->name('company-details');
//	Route::get('/all-companies', function () { return view('pages.all-companies'); });
	Route::get('/active-companies/{id}', function () { return view('pages.active-companies'); });
	Route::get('/add-company', function () { return view('pages.add-company'); });
	Route::get('/user', function () { return view('pages.users'); });
	Route::get('/add-keys', function () { return view('pages.add-keys'); });
	Route::get('/manage-users', function () { return view('pages.manage-users'); });
	Route::get('/assign-policy', function () { return view('pages.assign-policy'); });
	Route::get('/return-policy', function () { return view('pages.return-policy'); });
	Route::get('/updated-return-policy', function () { return view('pages.updated-return-policy'); });
	Route::get('/return-policy-report', function () { return view('pages.return-policy-report'); });
	Route::get('/assign-policy-report', function () { return view('pages.assign-policy-report'); });
	Route::get('/return-policy-type', function () { return view('pages.return-policy-type'); });
	Route::get('/manage-customers', function () { return view('pages.manage-customers'); });
	Route::get('/ama-customers', function () { return view('pages.ama-customers'); });
	Route::get('/edit-ama-customer', function () { return view('pages.edit-ama-customer'); });
	Route::get('/register-customer', function () { return view('pages.register-customer'); });
	

	// TODAY API'S 13-01-2024 START

	Route::get('/manage-role', [myroleController::class,'index']);
	Route::post('/create-role', [myroleController::class,'createrole'])->name('create-role');

	Route::get('/manage-company', [companyController::class,'index']);
	Route::get('/all-companies', [companyController::class,'index']);
	Route::post('/create-company', [companyController::class,'CreateCompany'])->name('create-company');
	Route::get('/edit-company/{company}', [companyController::class,'edit'])->name('edit-company');
	Route::post('/update-company', [companyController::class,'edit'])->name('edit-company');
	Route::get('/delete-company/{userid}/{id}', [companyController::class,'delete'])->name('delete-company');

	Route::get('/manage-superstokist', [superstokistController::class,'index']);
	Route::get('/add-superstokist', [superstokistController::class,'addSuperStokist']);
	Route::post('/create-superstokist', [superstokistController::class,'CreateSuperStokist'])->name('create-superstokist');
	Route::get('/delete-superstokist/{userid}/{id}', [superstokistController::class,'delete'])->name('delete-superstokist');
	
	Route::get('/manage-distributor', [distributorController::class,'index']);
	Route::get('/add-distributor', [distributorController::class,'addDistributor']);
	Route::post('/create-distributor', [distributorController::class,'CreateDistributor'])->name('create-distributor');
	Route::get('/delete-distributor/{userid}/{id}', [distributorController::class,'delete'])->name('delete-distributor');

	Route::get('/manage-employee', [employeeController::class,'index']);
	Route::get('/add-employee', [employeeController::class,'addEmployee']);
	Route::post('/create-employee', [employeeController::class,'CreateEmployee'])->name('create-employee');
	Route::get('/delete-employee/{userid}/{id}', [employeeController::class,'delete'])->name('delete-employee');

	Route::get('/manage-retailer', [retailerController::class,'index']);
	Route::get('/add-retailer', [retailerController::class,'addRetailer']);
	Route::post('/create-retailer', [retailerController::class,'CreateRetailer'])->name('create-retailer');
	Route::get('/delete-retailer/{userid}/{id}', [retailerController::class,'delete'])->name('delete-retailer');

	Route::get('/manage-customer', [customerController::class,'index']);
	Route::get('/add-customer', [customerController::class,'addCustomer']);
	Route::post('/create-customer', [customerController::class,'CreateCustomer'])->name('create-customer');
	Route::get('/delete-customer/{userid}/{id}', [customerController::class,'delete'])->name('delete-customer');


	// TODAY API'S 13-01-2024 END

	// COMPANY ROUTES END

	// SUPERSTOKIST ROUTES START
	Route::get('/superstokist-dashboard', function () {return view('pages.dashboard-superstokist');})->name('dashboard-superstokist');
	Route::get('/super-stokist-details', function () {return view('pages.super-stokist-details');})->name('super-stokist-details');
	Route::get('/all-superstokist', function () { return view('pages.all-superstokist'); });
	Route::get('/active-superstokist/{id}', function () { return view('pages.active-superstokist'); });
	// Route::get('/add-superstokist', function () { return view('pages.add-superstokist'); });

	// Route::get('/superstokist-dashboard',[SuperStokistController::class,'index'])->name('superstokist.index');
	// SUPERSTOKIST ROUTES END

	// DISTRIBUTOR ROUTES START
	Route::get('/distributor-dashboard', function () {return view('pages.dashboard-distributor');})->name('dashboard-distributor');
	Route::get('/distributor-details', function () {return view('pages.distributor-details');})->name('distributor-details');
	Route::get('/all-distributors', [DistributorController::class,'index']);
	// Route::get('/active-distributors/{id}', function () { return view('pages.active-distributors'); });
	// Route::get('/add-distributor', function () { return view('pages.add-distributor'); });
	// Route::get('/add-distributor', [DistributorController::class,'addDistributor']);
	// Route::post('/add-distributor', [DistributorController::class,'store'])->name('add-distributor');
	// Route::get('/distributors/get-list', [DistributorController::class,'getDistributorsList']);

	// DISTRIBUTOR ROUTES END

	// EMPLOYEE ROUTES START
	Route::get('/employee-dashboard', function () {return view('pages.dashboard-employee');})->name('dashboard-employee');
	Route::get('/employee-details', function () {return view('pages.employee-details');})->name('employee-details');
	// Route::get('/all-employees', function () { return view('pages.all-employees'); });
	// Route::get('/active-employees/{id}', function () { return view('pages.active-employees'); });
	// Route::get('/add-employee', function () { return view('pages.add-employee'); });

	// HERE WE CREATE ROUTES FOR OUR APPLICATION
	Route::get('/all-employees', [EmployeeController::class,'index']);
	Route::get('/add-employee', [EmployeeController::class,'addemployee']);
	Route::post('/add-employee', [EmployeeController::class,'store'])->name('add-employee');
	Route::get('/employees/get-list', [EmployeeController::class,'getEmployeeList']);
	// EMPLOYEE ROUTES END

	// RETAILER ROUTES START
	Route::get('/retailer-dashboard', function () {return view('pages.dashboard-retailer');})->name('dashboard-retailer');
	Route::get('/retailer-details', function () {return view('pages.retailer-details');})->name('retailer-details');
	// Route::get('/all-retailers', function () { return view('pages.all-retailers'); });
	// Route::get('/active-retailers/{id}', function () { return view('pages.active-retailers'); });
	// Route::get('/add-retailer', function () { return view('pages.add-retailer'); });

	// HERE WE CREATE OUR ROUTES 
	Route::get('/edit-retailer', [RetailerController::class,'editretailer']);
	Route::get('/add-retailer', [RetailerController::class,'addRetailer']);
	Route::post('/add-retailer', [RetailerController::class,'store'])->name('add-retailer');
	Route::get('/all-retailers', [RetailerController::class,'index']);
	Route::get('/retailers/get-list', [RetailerController::class,'getRetailersList']);

	// RETAILER ROUTES END

	// CUSTOMER ROUTES START
	Route::get('/customer-details', function () {return view('pages.customer-details');})->name('customer-details');
	// Route::get('/all-customers', function () { return view('pages.all-customers'); });
	// Route::get('/add-customer', function () { return view('pages.add-customer'); });
	Route::get('/add-customer', [CustomerController::class,'addCustomer']);
	Route::post('/add-customer', [CustomerController::class,'store'])->name('add-customer');
	Route::get('/all-customers', [CustomerController::class,'index']);
	Route::get('/ama-devices', [CustomerController::class,'ama_devices']);
	Route::get('/customers/get-list', [CustomerController::class,'getCustomersList']);
	// CUSTOMER ROUTES END

	// POLICIES ROUTES START
	Route::get('/policy-details', function () {return view('pages.policy-details');})->name('policy-details');
	Route::get('/request-keys', function () { return view('pages.request-keys'); });
	Route::get('/requested-keys', function () { return view('pages.requested-keys'); });
	// POLICIES ROUTES END

	// SAMPLE PROJECT END
});

Route::get('/register', function () { return view('pages.register'); });
Route::get('/login-1', function () { return view('pages.login'); });
