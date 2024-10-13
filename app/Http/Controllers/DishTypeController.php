<?php

namespace App\Http\Controllers;

use App\Models\DishType;
use App\Traits\APIResponse;
use Illuminate\Http\Request;

class DishTypeController extends Controller
{
    use APIResponse;

    /**
     * Display a listing of dish types.
     */
    public function index()
    {
        $dishTypes = DishType::all();

        return $this->success($dishTypes);
    }

    /**
     * Store a newly created dish type in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $dishType = DishType::create($request->all());

        return $this->success($dishType, 'Dish type created successfully', 201);
    }

    /**
     * Display the specified dish type.
     */
    public function show(string $id)
    {
        $dishType = DishType::find($id);

        if (! $dishType) {
            return $this->error('Dish type not found', 404);
        }

        return $this->success($dishType);
    }

    /**
     * Update the specified dish type in storage.
     */
    public function update(Request $request, string $id)
    {
        $dishType = DishType::find($id);

        if (! $dishType) {
            return $this->error('Dish type not found', 404);
        }

        $request->validate([
            'name' => 'required',
        ]);

        $dishType->update($request->all());

        return $this->success($dishType, 'Dish type updated successfully');
    }

    /**
     * Remove the specified dish type from storage.
     */
    public function destroy(string $id)
    {
        $dishType = DishType::find($id);

        if (! $dishType) {
            return $this->error('Dish type not found', 404);
        }

        $dishType->delete();

        return $this->success(null, 'Dish type deleted successfully');
    }
}
