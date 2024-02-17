<?php

declare(strict_types=1);

namespace App\V1\Modules\Houses\Thermostats\UI\Http\Controllers;

use App\V1\Core\UI\Http\Controllers\Controller;
use App\V1\Modules\Houses\Thermostats\Application\Commands\StoreTemperatureLogCommand;
use App\V1\Modules\Houses\Thermostats\UI\Http\Requests\StoreThermostatTemperatureLogRequest;
use Symfony\Component\HttpFoundation\Response;

class ThermostatTemperatureLogController extends Controller
{
    public function store(StoreThermostatTemperatureLogRequest $request)
    {
        $this->commandBus->dispatch(
            StoreTemperatureLogCommand::fromArray($request->validated())
        );

        return $this->responseFactory->json([
            'message' => __('thermostat::messages.temperature_log_created'),
        ], Response::HTTP_CREATED);
    }
}
