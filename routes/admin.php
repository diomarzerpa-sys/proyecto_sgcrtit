<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClassificationController;
use App\Http\Controllers\Admin\ComponentController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\MemoController;
use App\Http\Controllers\Admin\NationalAssetsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('departments', DepartmentController::class)
    ->middleware('can:admin.departments.index', 'can:admin.departments.create','can:admin.departments.edit','can:admin.departments.destroy');

Route::resource('categories',CategoryController::class)
    ->middleware('can:admin.categories.index', 'can:admin.categories.create','can:admin.categories.edit','can:admin.categories.destroy');

Route::resource('staffs', StaffController::class)
    ->middleware('can:admin.staffs.index', 'can:admin.staffs.create','can:admin.staffs.show', 'can:admin.staffs.edit','can:admin.staffs.destroy');

Route::get('/memos/{id}/pdf', [MemoController::class, 'exportPdf'])->middleware('can:admin.memos.print')->name('memos.print');
Route::resource('memos', MemoController::class)
    ->middleware('can:admin.memos.index', 'can:admin.memos.create', 'can:admin.memos.show', 'can:admin.memos.edit','can:admin.memos.destroy');

Route::resource('managers', ManagerController::class)
    ->middleware('can:admin.managers.index', 'can:admin.managers.create','can:admin.managers.edit','can:admin.managers.destroy');

Route::resource('projects', ProjectController::class)
    ->middleware('can:admin.projects.index', 'can:admin.projects.create', 'can:admin.projects.show', 'can:admin.projects.edit','can:admin.projects.destroy');

Route::resource('classifications', ClassificationController::class)
    ->middleware('can:admin.classifications.index', 'can:admin.classifications.create','can:admin.classifications.edit','can:admin.classifications.destroy');

Route::resource('national_assets', NationalAssetsController::class)
    ->middleware('can:admin.national_assets.index', 'can:admin.national_assets.create', 'can:admin.national_assets.show', 'can:admin.national_assets.edit','can:admin.national_assets.destroy');

Route::resource('components', ComponentController::class)
    ->middleware('can:admin.components.index', 'can:admin.components.create','can:admin.components.edit','can:admin.components.destroy');

Route::resource('users', UserController::class)
    ->middleware('can:admin.users.index', 'can:admin.users.create','can:admin.users.edit','can:admin.users.destroy');

Route::resource('tools', ToolController::class)
    ->middleware('can:admin.tools.index', 'can:admin.tools.create','can:admin.tools.edit','can:admin.tools.destroy');