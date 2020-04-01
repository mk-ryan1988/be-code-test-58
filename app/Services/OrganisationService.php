<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use App\Notifications\OrgaisationCreated;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $organisation->name = $attributes['name'];
        $organisation->owner_user_id = Auth::id();
        $organisation->trial_end = Carbon::now()->addDays(30)->timestamp;
        $organisation->subscribed = $attributes['subscribed'];

        $organisation->save();

        Notification::send(Auth::User(), new OrgaisationCreated($organisation));

        return $organisation;
    }

    /**
     * @param Request $filter
     *
     * @return Organisation
     */
    public function listOrganisations($filter)
    {
        $Organisations = array();

        if (isset($filter)) {
            switch ($filter) {
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
