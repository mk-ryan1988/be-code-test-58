<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{
    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function createOrganisation(array $attributes): Organisation
    {
        $organisation = new Organisation();

        return $organisation;
    }

    /**
     * @param Request $request
     *
     * @return Organisation
     */
    public function listOrganisations(Request $request)
    {
        $Organisations = array();

        if ($request->filled('filter')) {
            switch ($request->query('filter')) {
                case 'subbed':
                    $Organisations = Organisation::where('subscribed', 1)->get();
                    break;

                case 'trial':
                    $Organisations = Organisation::whereDate('trial_end','>=',Carbon::today()->toDateString())->get();
                    break;
            }
        } else {
            $Organisations = Organisation::all();
        }

        return json_encode($Organisations);
    }
}
