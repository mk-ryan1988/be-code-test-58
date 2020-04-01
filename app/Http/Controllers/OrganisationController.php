<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogPost;
use App\Organisation;
use App\Services\OrganisationService;

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
    public function index(OrganisationService $service)
    {
        $organisations = $service->listOrganisations($this->request);

        return $organisations;
    }

    /**
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function store(StoreBlogPost $request, OrganisationService $service): JsonResponse
    {
        /** @var Organisation $organisation */
        $organisation = $service->createOrganisation($request->validated());

        return $this
            ->transformItem('organisation', $organisation, ['user'])
            ->respond();
    }
}
