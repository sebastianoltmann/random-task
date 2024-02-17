<?php

declare(strict_types=1);

namespace App\V1\Core\UI\Http\Controllers;

use App\V1\Core\Application\Command\CommandBusInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function __construct(
        protected readonly CommandBusInterface $commandBus,
        protected readonly ResponseFactory $responseFactory,
    ) {
    }
}
