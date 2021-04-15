<?php

namespace App\Services\Kitchen\Operations;

use Lucid\Units\Operation;
use App\Domains\Recipe\Jobs\ParseIngredientsJob;
use App\Domains\Recipe\Jobs\CalculateIngredientsTotalJob;

class CalculateRecipePriceOperation extends Operation
{
    private string $ingredients;
    /**
     * Create a new operation instance.
     *
     * @return void
     */
    public function __construct(string $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * Execute the operation.
     *
     * @return void
     */
    public function handle()
    {
        $ingredients = $this->run(ParseIngredientsJob::class, [
            'ingredients' => $this->ingredients,
        ]);

        return $this->run(new CalculateIngredientsTotalJob($ingredients));
    }
}
