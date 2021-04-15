<?php

namespace App\Domains\Recipe\Jobs;

use Lucid\Units\Job;

class CalculateIngredientsTotalJob extends Job
{
    private IngredientsCollection $ingredients;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(IngredientsCollection $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): float
    {
        return $this->ingredients->sum('total');
    }
}
