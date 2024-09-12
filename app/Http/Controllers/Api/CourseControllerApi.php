<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelpersController;
use App\Models\ColisImage;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Course::with('client', 'driver', 'colis_images')->get();
        return HelpersController::responseApi(
            200,
            "success",
            $all
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'description' => 'required|string|max:255',
            'client_id' => 'required|integer|exists:users,id',
            'lieu_depart' => 'required|string|max:255',
            'lieu_arrivee' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails() && !$request->hasFile('files')) {
            return HelpersController::responseApi(
                200,
                "fields is required",
                null
            );
        }
        $course = new Course();
        $course->description = $request->description;
        $course->code = '#Course-' . HelpersController::generateRandomString(5);
        $course->user_id = $request->client_id;
        $course->lieu_depart = $request->lieu_depart;
        $course->lieu_arrivee = $request->lieu_arrivee;
        $course->save();

        foreach ($request->file('files') as $file) {
//        / response()->json($file->store('public/colis/image', 'public'));
            $image_name = uniqid('colis_image') . time() . '.' . $file->getClientOriginalExtension();
//            $course->colis_images()->create([
//                'course_id' => $course->id,
//                'image' => 'storage/colis/image/' . $image_name,
//                'image_time' => 'depart',
//                'status' => 1
//            ]);
            $colisImage = new ColisImage();
            $colisImage->course_id = $course->id;
            $colisImage->image = 'storage/colis/image/' . $image_name;
            $colisImage->image_time = 'depart';
            $colisImage->status = 1;
            $colisImage->save();
            $file->storeAs('public/colis/image', $image_name);
        }
//die;
        $course = Course::with('client', 'driver', 'colis_images')->find($course->id);

        return HelpersController::responseApi(
            200,
            "success",
            $course
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
