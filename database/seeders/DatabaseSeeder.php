<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use App\Repositories\CarRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var CarRepository
     */
    private CarRepository $carRepository;

    public function __construct(UserRepository $userRepository, CarRepository $carRepository)
    {
        $this->userRepository = $userRepository;
        $this->carRepository = $carRepository;
    }
    
    public function run()
    {
        if ($this->userRepository->count() === 0) {
            User::factory(20)->create();
        }

        if ($this->carRepository->count() === 0) {
            Car::factory(30)->create();
        }
    }
}
