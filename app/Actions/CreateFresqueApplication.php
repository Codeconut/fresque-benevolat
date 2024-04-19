<?php

namespace App\Actions;

use App\Models\FresqueApplication;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CreateFresqueApplication
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function apply(array $inputs): FresqueApplication
    {
        Validator::make($inputs, [
            'fresque_id' => 'required|exists:fresques,id',
            'email' => [
                'required',
                'email',
                Rule::unique('fresque_applications')->where(function ($query) use ($inputs) {
                    return $query->where('fresque_id', $inputs['fresque_id'])->where('email', $inputs['email']);
                })
            ],
            'first_name' => 'required',
            'last_name' => 'required',
            'info_benevolat' => 'required',
            'info_fresque' => 'required',
            'has_accepted_emails' => 'required|boolean|in:1',
        ])->validate();

        return FresqueApplication::create([
            'fresque_id' => $inputs['fresque_id'],
            'email' => $inputs['email'],
            'first_name' => $inputs['first_name'],
            'last_name' => $inputs['last_name'],
        ]);
    }
}
