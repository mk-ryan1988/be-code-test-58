<?php

declare(strict_types=1);

namespace App\Transformers;

use App\Organisation;
use League\Fractal\TransformerAbstract;

/**
 * Class OrganisationTransformer
 * @package App\Transformers
 */
class OrganisationTransformer extends TransformerAbstract
{
    /**
     * @param Organisation $organisation
     *
     * @return array
     */
    public function transform(Organisation $organisation): array
    {
        return [
            'id' => $organisation->id,
            'name' => $organisation->name,
            'trail_end' => $organisation->trial_end ?? Carbon::parse($organisation->trial_end)->timestamp,
            'subscribed' => $organisation->subscribed,
            'created_at' => $organisation->created_at ?? Carbon::parse($organisation->created_at)->timestamp,
            'updated_at' => $organisation->created_at ?? Carbon::parse($organisation->created_at)->timestamp
        ];
    }

    /**
     * @param Organisation $organisation
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Organisation $organisation)
    {
        return $this->item($organisation->user, new UserTransformer());
    }
}
