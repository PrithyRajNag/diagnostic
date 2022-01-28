<?php

namespace App\Repository;

interface UserRepositoryInterface extends EloquentRepositoryInterface {
    public function login(array $request): bool | string;
}
