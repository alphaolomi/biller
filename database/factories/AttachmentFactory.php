<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'bill_id' => \App\Models\Bill::factory(),
            'file_path' => null,
        ];
    }

    // download the file from the internet and save it to the storage
    public function withRealFile(): self
    {
        return $this->state(function (array $attributes) {
            $file = file_get_contents('https://picsum.photos/200/300');
            $path = 'attachments/'.$this->faker->uuid.'.jpg';
            Storage::disk('public')->put($path, $file);

            return ['file_path' => $path];
        });
    }

    // withNullFile
    public function withNullFile(): self
    {
        return $this->state(function (array $attributes) {
            $path = 'attachments/'.$this->faker->uuid.'.jpg';
            Storage::disk('public')->put($path, '');

            return ['file_path' => $path];
        });
    }

    public function withFile(): self
    {
        return $this->state(function (array $attributes) {
            $path = 'attachments/'.$this->faker->uuid.'.jpg';
            Storage::disk('public')->put($path, '');

            return ['file_path' => $path];
        });
    }
}
