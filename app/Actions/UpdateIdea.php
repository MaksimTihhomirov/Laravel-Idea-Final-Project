<?php

namespace App\Actions;

use App\Models\Idea;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateIdea
{
    public function handle(array $attributes, Idea $idea): Idea
    {
        $data = Arr::only($attributes, [
            'title',
            'description',
            'status',
        ]);

        $data['links'] = $attributes['links'] ?? [];

        $oldImagePath = $idea->image_path;
        $newImagePath = null;

        if (! empty($attributes['image'])) {
            $newImagePath = $attributes['image']->store('ideas', 'public');

            if ($newImagePath === false) {
                throw new \RuntimeException('Image upload failed.');
            }

            $data['image_path'] = $newImagePath;
        } elseif (! empty($attributes['remove_image'])) {
            $data['image_path'] = null;
        }

        try {
            DB::transaction(function () use ($idea, $data, $attributes) {
                $idea->update($data);

                $existingSteps = $idea->steps()->get()
                    ->groupBy('description');

                $idea->steps()->delete();

                foreach ($attributes['steps'] ?? [] as $description) {
                    $previous = $existingSteps->get($description)?->shift();

                    $idea->steps()->create([
                        'description' => $description,
                        'completed' => $previous?->completed ?? false,
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            if ($newImagePath) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $exception;
        }

        if ($oldImagePath && $oldImagePath !== $idea->image_path) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return $idea->refresh();
    }
}