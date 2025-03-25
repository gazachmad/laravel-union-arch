<?php

namespace App\Http\Middleware\Authenticated;

use App\Modules\Auth\Core\Domain\Models\User\UserId;
use App\Modules\Auth\Core\Domain\Repositories\UserRepository;
use Closure;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatedMiddleware
{
    public function __construct(
        private UserRepository $user_repository,
        private ConnectionInterface $db
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->user_repository->findById(new UserId($request->user()->id));

        if (!$user) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        View::share('auth_user', new AuthenticatedResponse(
            $user->getName(),
            $user->getPhoneNumber(),
            $user->getEmail(),
            $user->getInitial(),
        ));

        return $next($request);
    }
}
