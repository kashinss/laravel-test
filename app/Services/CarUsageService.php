<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;

class CarUsageService
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $userId
     * @param int $carId
     * @return void
     */
    public function setCarIdToUser(int $userId, int $carId): void
    {
        $this->userRepository->setCarId($userId, $carId);
    }

    /**
     * @param int $userId
     * @return void
     */
    public function removeCarIdFromUser(int $userId): void
    {
        $this->userRepository->setCarId($userId, null);
    }

    /**
     * @return array
     */
    public function getCarUsageList(): array
    {
        $carUsageList = [];
        $users = $this->userRepository->getUsersWithCars();
        if (!empty($users)) {
            foreach ($users as $user) {
                $carUsageList[] = [
                    'userId' => $user->id,
                    'userName' => $user->full_name,
                    'carId' => $user->car_id,
                    'carName' => $user->car->name
                ];
            }
        }

        return $carUsageList;
    }
}
