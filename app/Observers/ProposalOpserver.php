<?php

namespace App\Observers;

use App\Models\Proposal;


class ProposalObserver 
{
    /**
     * Handle the Proposal "created" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function created(Proposal $proposal)
    {
        $this->generateCode($proposal);
    }

    /**
     * Handle the Proposal "saved" event.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function saved(Proposal $proposal)
    {
        $this->generateCode($proposal);        
    }

    /**
     * Handle the Proposal code generating.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return void
     */
    public function generateCode(Proposal $proposal)
    {    
        // Saveing the code attribute
        $type = uperFirstLetter($proposal->type);
        $approval_from = uperFirstLetter($proposal->approval_from);
        $proposal_no = $proposal->id;
        $client_source = uperFirstLetter($proposal->client_source);
        $sales_agent = uperFirstLetter($proposal->user->name);
        $proposal->code = $type . $approval_from . '-' . $proposal_no . '-' . $client_source . $sales_agent;
        $proposal->save();
    }
}