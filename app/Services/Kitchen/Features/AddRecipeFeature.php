<?php

namespace App\Services\Kitchen\Features;

use Lucid\Units\Feature;
use Illuminate\Http\Request;
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
    }
}
