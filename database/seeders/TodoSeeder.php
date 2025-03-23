<?php

namespace Database\Seeders;

use App\Modules\Shared\Model\DateTime;
use App\Modules\Todos\Core\Domain\Models\Todo\Todo;
use App\Modules\Todos\Core\Domain\Models\Todo\TodoId;
use App\Modules\Todos\Core\Domain\Repositories\Todo\TodoRepository;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    public function __construct(private TodoRepository $todo_repository) {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a Faker instance
        $faker = Factory::create();

        // Insert 10 random todos into the 'todos' table
        for ($i = 0; $i < 50; $i++) {
            $this->todo_repository->persist(
                new Todo(
                    TodoId::generate(),
                    $faker->sentence,
                    $faker->paragraph,
                    $faker->boolean,
                    new DateTime('@' . $faker->dateTimeBetween('-1 year', 'now')->getTimestamp()),
                    null,
                )
            );
        }
    }
}
