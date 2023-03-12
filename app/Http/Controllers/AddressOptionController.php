<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Adress;
use Illuminate\Http\Request;
use App\Http\Requests\AddressOptionRequest;

class AddressOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Add');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressOptionRequest $request)
    {
        try {
           
            $adress=new Adress;


            $adress->user_id = auth()->user()->id;
            $adress->addr1 = $request->get('addr1');
            $adress->addr2 = $request->get('addr2');
            $adress->city = $request->get('city');
            $adress->postcode = $request->get('postcode');
            $adress->country = $request->get('country');

            $adress->save();

            return redirect()->route('address.index');
    

        } catch (\Exception $e) {
            return response()->json([
                $e->getMessage(),
            ]);
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $address = Adress::find($id);
            $address->delete();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

}
