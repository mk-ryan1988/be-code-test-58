<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganisation;
use App\Organisation;
use App\Services\OrganisationService;
use App\Transformers\OrganisationTransformer;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    /**
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function index(OrganisationService $service, $filter = null)
    {
        $organisations = $service->listOrganisations($filter);

        return fractal($organisations, new OrganisationTransformer());
    }

    /**
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function store(StoreOrganisation $request, OrganisationService $service)
    {
        /** @var Organisation $organisation */
        $organisation = $service->createOrganisation($request->validated());

        return fractal($organisation, new OrganisationTransformer())->respond();
    }
}
