<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ReviewCollection;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new ReviewCollection(Review::all())
                                , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request, $idb, $idu)
    {
        /*var_dump($request->all());
        echo "<hr/>";
        var_dump($id);*/

        $review = new Review(); 
        $review->title = $request->title;
        $review->text = $request->text;
        $review->rating = $request->rating;
        $review->bootcamp_id = $idb;
        $review->user_id = $idu;      
        $review->save();   

        //Enviar response
        return response()->json([
            "success" => true,
            "data" => $review
        ] , 201);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Aquí se va a actualizar el Curso con id: $id
        // echo "Aquí se va a actualizar el Curso con id: $id";
        //1. Seleccionar Curso por id 
        $review = Review::find($id);

        //2. Actualizarlo
        $review->update(
            $request->all()
        );

        //3. Hacer el response respectivo
        return response()->json(
            [
                "success" => true,
                "data" =>  new ReviewResource($review)
            ],200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
