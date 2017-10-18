<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateapartmentRequest;
use App\Notifications\ApartmentPosted;
use Illuminate\Support\Facades\Notification;
use App\Apartment;

class ApiApartmentsController extends Controller
{

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

    public function show(Apartment $apartment)
    {
        $apartment = Apartment::whereId($apartment->id)->first();
        if ($image = $apartment->getFirstMediaUrl('featured')) {
            $apartment['image'] = url($image);
        }

        return $apartment;
    }

    public function store(CreateapartmentRequest $request)
    {

        $input = $request->except(['file']);

        $input['token'] = str_random(60);

        $apartment = Apartment::create($input);

        $apartment->featuredImage($request);

        Notification::route('mail', $apartment->email)
            ->notify(new ApartmentPosted($apartment));

        return response()->json([
            'message' => 'Item Posted',

        ], 200);
    }


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
}
