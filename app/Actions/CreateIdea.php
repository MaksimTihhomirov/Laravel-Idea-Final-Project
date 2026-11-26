<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateIdea
{
    public function handle(array $attributes, User $user): Idea
    {
        $steps = $attributes['steps'] ?? [];

        $data = Arr::only($attributes, [
            'title',
            'description',
            'status',
            'links',
        ]);

        $imagePath = null;

        if (! empty($attributes['image'])) {
            $imagePath = $attributes['image']->store('ideas', 'public');

            if ($imagePath === false) {
                throw new \RuntimeException('Image upload failed.');
            }
        }

        $data['image_path'] = $imagePath;

        try {
            return DB::transaction(function () use ($data, $steps, $user) {
                $idea = $user->ideas()->create($data);

                foreach ($steps as $description) {
                    $idea->steps()->create([
                        'description' => $description,
                        'completed' => false,
                    ]);
                }

                return $idea;
            });
        } catch (\Throwable $exception) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            throw $exception;
        }
    }
}