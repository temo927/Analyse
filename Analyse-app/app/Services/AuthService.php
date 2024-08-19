<?php

declare(strict_types=1);

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

readonly class AuthService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function register(array $data): string
    {
        $user = $this->userRepository->create($data);
        return $user->createToken('Personal Access Token')->plainTextToken;
    }

    public function login(array $credentials): ?string
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return $user->createToken('Personal Access Token')->plainTextToken;
        }

        return null;
    }
}

