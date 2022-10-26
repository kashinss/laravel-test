<?php

namespace Tests\Feature;

use App\Repositories\CarRepository;
use App\Repositories\UserRepository;
use Str;
use Tests\TestCase;

class CarUsageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private UserRepository $userRepository;
    private CarRepository $carRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->make('App\Repositories\UserRepository');
        $this->carRepository = $this->app->make('App\Repositories\CarRepository');
    }

    public function test_public_list_allowed()
    {
        $response = $this->get('/api/car-usage/list');

        $response->assertStatus(200);
    }

    public function test_can_set_car()
    {
        $testUser = $this->userRepository->create([
            'full_name' => fake()->name(),
            'car_id' => null
        ]);
        $testCar = $this->carRepository->create([
            'name' => Str::random(7)
        ]);
        $response = $this->put('/api/car-usage/set', [
            'userId' => $testUser->id,
            'carId' => $testCar->id
        ]);
        $this->userRepository->deleteById($testUser->id);
        $this->carRepository->deleteById($testCar->id);

        $response->assertStatus(200);
    }

    public function test_set_car_validation()
    {
        $response = $this->put('/api/car-usage/set', [
            'userId' => 'jdgtjd',
            'carId' => 'sdfsdf'
        ]);

        $response->assertStatus(400);
    }

    public function test_set_car_unique()
    {
        $testUser = $this->userRepository->create([
            'full_name' => fake()->name(),
            'car_id' => null
        ]);
        $testUser2 = $this->userRepository->create([
            'full_name' => fake()->name(),
            'car_id' => null
        ]);
        $testCar = $this->carRepository->create([
            'name' => Str::random(7)
        ]);
        $this->put('/api/car-usage/set', [
            'userId' => $testUser->id,
            'carId' => $testCar->id
        ]);
        $response = $this->put('/api/car-usage/set', [
            'userId' => $testUser2->id,
            'carId' => $testCar->id
        ]);
        $this->userRepository->deleteById($testUser->id);
        $this->userRepository->deleteById($testUser2->id);
        $this->carRepository->deleteById($testCar->id);

        $response->assertStatus(500);
    }

    public function test_can_remove()
    {
        $testUser = $this->userRepository->create([
            'full_name' => fake()->name(),
            'car_id' => null
        ]);
        $testCar = $this->carRepository->create([
            'name' => Str::random(7)
        ]);
        $this->put('/api/car-usage/set', [
            'userId' => $testUser->id,
            'carId' => $testCar->id
        ]);
        $response = $this->put('/api/car-usage/remove', [
            'userId' => $testUser->id,
        ]);
        $this->userRepository->deleteById($testUser->id);
        $this->carRepository->deleteById($testCar->id);

        $response->assertStatus(200);
    }
}
