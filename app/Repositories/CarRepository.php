<?php

namespace App\Repositories;

use App\Models\Car;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class CarRepository.
 */
class CarRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */

    public function model()
    {
        return Car::class;
    }

    public function getAll()
    {
        return Car::all();
    }

}
