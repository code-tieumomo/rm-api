<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Traits\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IngredientController extends Controller
{
    use APIResponse;

    /**
     * Display a listing of ingredients.
     */
    public function index()
    {
        $ingredients = Ingredient::all();

        return $this->success($ingredients);
    }

    /**
     * Store a newly created ingredient in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|file|image',
            'amount' => 'required|numeric',
        ]);

        $ingredient = Ingredient::create($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('ingredients');
            $ingredient->image = Storage::url($path);
            $ingredient->save();
        }

        return $this->success($ingredient, 'Ingredient created successfully', 201);
    }

    /**
     * Display the specified ingredient.
     */
    public function show(string $id)
    {
        $ingredient = Ingredient::find($id);

        if (! $ingredient) {
            return $this->error('Ingredient not found', 404);
        }

        return $this->success($ingredient);
    }

    /**
     * Update the specified ingredient in storage.
     */
    public function update(Request $request, string $id)
    {
        $ingredient = Ingredient::find($id);

        if (! $ingredient) {
            return $this->error('Ingredient not found', 404);
        }

        $request->validate([
            'name' => 'required',
            'image' => 'nullable|file|image',
            'amount' => 'required|numeric',
        ]);

        $ingredient->update($request->except('image'));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('ingredients');
            $ingredient->image = Storage::url($path);
            $ingredient->save();
        }

        $ingredient->save();

        return $this->success($ingredient, 'Ingredient updated successfully');
    }

    /**
     * Remove the specified ingredient from storage.
     */
    public function destroy(string $id)
    {
        $ingredient = Ingredient::find($id);

        if (! $ingredient) {
            return $this->error('Ingredient not found', 404);
        }

        $ingredient->delete();

        return $this->success(null, 'Ingredient deleted successfully');
    }
}
