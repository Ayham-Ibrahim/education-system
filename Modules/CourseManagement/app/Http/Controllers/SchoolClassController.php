<?php

namespace Modules\CourseManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\CourseManagement\Models\SchoolClass;
use Modules\CourseManagement\Http\Requests\StoreClassRequest;
use Modules\CourseManagement\Transformers\CourseResource;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::all();
        return ApiResponseService::success($classes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRequest $request)
    {
        $data = $request->validated();
        $schoolClass = SchoolClass::create($data);
        return ApiResponseService::success($schoolClass,"created successfully",201);

    }

    /**
     * Show the specified resource.
     */
    public function show(SchoolClass $schoolClass)
    {
        return ApiResponseService::success($schoolClass);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreClassRequest $request,SchoolClass $schoolClass)
    {
        $data = $request->validated();
        $schoolClass->Update(array_filter($data));
        return ApiResponseService::success($schoolClass);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
        return response()->json('deleted successfully');
    }
}
