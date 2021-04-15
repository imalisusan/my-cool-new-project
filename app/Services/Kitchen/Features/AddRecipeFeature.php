<?php

namespace App\Services\Kitchen\Features;

use Lucid\Units\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\Recipe\Jobs\SaveRecipeJob;
use App\Domains\Recipe\Requests\AddRecipe;
use App\Domains\Recipe\Jobs\ParseIngredientsJob;
use App\Domains\Recipe\Jobs\CalculateIngredientsTotalJob;
use App\Services\Kitchen\Operations\CalculateRecipePriceOperation;

class AddRecipeFeature extends Feature
{
    public function handle(AddRecipe $request)
    {
        $price = $this->run(CalculateRecipePriceOperation::class, [
            'ingredients' => $request->input('ingredients'),
        ]);

        $this->run(SaveRecipeJob::class, [
            'title' => $request->input('title'),
            'ingredients' => $request->input('ingredients'),
            'instructions' => $request->input('instructions'),
            'price' => $price,
            'user' => Auth::user(),
        ]);

        return $this->run(RedirectBackJob::class);
    }
}
