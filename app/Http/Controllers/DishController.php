<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Traits\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    use APIResponse;

    /**
     * Display a listing of dishes.
     */
    public function index()
    {
        $dishes = Dish::all();

        return $this->success($dishes);
    }

    /**
     * Store a newly created dish in storage.
     *
     * @requestMediaType multipart/form-data
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'nullable',
            'id_type' => 'required|exists:dish_types,id',
            'information' => 'nullable',
            'image_url' => 'nullable|file|image',
        ]);

        $dish = Dish::create($request->except('image_url'));

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('dishes');
            $dish->image_url = Storage::url($path);
        }

        $dish->save();

        return $this->success($dish, 'Dish created successfully', 201);
    }

    /**
     * Display the specified dish.
     */
    public function show(string $id)
    {
        $dish = Dish::find($id);

        if (! $dish) {
            return $this->error('Dish not found', 404);
        }

        return $this->success($dish);
    }

    /**
     * Update the specified dish in storage.
     *
     * @requestMediaType multipart/form-data
     */
    public function update(Request $request, string $id)
    {
        $dish = Dish::find($id);

        if (! $dish) {
            return $this->error('Dish not found', 404);
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'status' => 'nullable',
            'id_type' => 'required|exists:dish_types,id',
            'information' => 'nullable',
            'image_url' => 'nullable|file|image',
        ]);

        $dish->update($request->except('image_url'));

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('dishes');
            $dish->image_url = Storage::url($path);
        }

        $dish->save();

        return $this->success($dish, 'Dish updated successfully');
    }

    /**
     * Remove the specified dish from storage.
     */
    public function destroy(string $id)
    {
        $dish = Dish::find($id);

        if (! $dish) {
            return $this->error('Dish not found', 404);
        }

        $dish->delete();

        return $this->success(null, 'Dish deleted successfully');
    }
}
