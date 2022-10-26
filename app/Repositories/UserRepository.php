<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class UserRepository.
 *
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::all();
    }

    /**
     * @param $id
     * @param array $columns
     * @return User|null
     */
    public function getById($id, array $columns = ['*']): User|null
    {
        return (new User())->find($id);
    }

    /**
     * @param int $id
     * @param int|null $carId
     * @return void
     */
    public function setCarId(int $id, ?int $carId): void
    {
        $user = $this->getById($id);
        $user->update(['car_id' => $carId]);
        $user->save();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUsersWithCars(): \Illuminate\Support\Collection
    {
        return (new User())->whereNotNull('car_id')->get();
    }
}
