<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateapartmentRequest;
use App\Http\Requests\Request;
use App\Notifications\ApartmentPosted;
use Illuminate\Support\Facades\Notification;
use App\Apartment;
use Psy\Util\Json;

class ApiApartmentsController extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        $apartments = Apartment::latest()->paginate(6);
        $apartments->map(function ($apartment) {
            if ($image = $apartment->getFirstMediaUrl('featured', 'thumb')) {
                $apartment['thumb'] = url($image);
                return $apartment;
            }
        });
        return $apartments;
    }
    /**
     * @param Apartment $apartment
     * @return Apartment
     */
    public function show(Apartment $apartment)
    {
        $apartment = Apartment::whereId($apartment->id)->first();
        if ($image = $apartment->getFirstMediaUrl('featured')) {
            $apartment['image'] = url($image);
        }

        return $apartment;
    }

    /**
     * @param CreateapartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateapartmentRequest $request)
    {

        dd($request->all());

        $input = $request->except(['file', 'thumb']);

        $input['token'] = str_random(60);

        $apartment = Apartment::create($input);

        //     $apartment->featuredImage($request);
//
//        Notification::route('mail', $apartment->email)
//            ->notify(new ApartmentPosted($apartment));

        return response()->json([
            'message' => 'Item Posted',
        ], 200);
    }

    /**
     * @param $id
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id, $token)
    {
        if ($apartment = Apartment::whereId($id)->whereToken($token)->first()) {

            if ($image = $apartment->getFirstMediaUrl('featured', 'thumb')) {
                $apartment['thumb'] = url($image);
            }
            return $apartment;
        }
        return response()->json([
            'message' => 'Unauthorized Access',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Apartment $apartment
     * @param  CreateapartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Apartment $apartment, CreateapartmentRequest $request)
    {
        if ($apartment = Apartment::whereId($apartment->id)->whereToken($apartment->token)->first()) {

            $input = $request->except(['file']);

            $apartment->fill($input)->save();

            $apartment->featuredImage($request);

            return response()->json([
                'message' => 'Updated',
            ], 200);

        } else {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, $token)
    {
        if ($apartment = Apartment::whereId($id)->whereToken($token)->first()) {
            $apartment->delete();
            return response()->json([
                'message' => 'Apartment Deleted',
            ]);
        } else {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        }
    }
    public function test1()
    {
        $apartments = Apartment::paginate(5);
        $apartments->map(function ($apartment) {
            if ($image = $apartment->getFirstMediaUrl('featured', 'thumb')) {
                $apartment['thumb'] = url($image);
                return $apartment;
            }
        });
        return $apartments;
    }

    public function test2()
    {
        return response()->json([
            "total" => 3,
            "per_page" => 8,
            "current_page" => 1,
            "last_page" => 1,
            "next_page_url" => null,
            "prev_page_url" => null,
            "from" => '',
            "to" => ''
        ]);

    }
}

