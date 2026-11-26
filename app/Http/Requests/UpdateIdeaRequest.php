<?php

namespace App\Http\Requests;

class UpdateIdeaRequest extends StoreIdeaRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('idea')) ?? false;
    }

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'remove_image' => ['sometimes', 'boolean'],
        ]);
    }
}
