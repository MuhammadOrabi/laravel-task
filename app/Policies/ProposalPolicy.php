<?php

namespace App\Policies;

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the proposal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return mixed
     */
    public function view(User $user)
    {
        return true;
        if ($user->getRole('App\Models\Proposal', 'view')) {
            return true;
        }
    }

    /**
     * Determine whether the user can create proposal.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->getRole('App\Models\Proposal', 'create')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the proposal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->getRole('App\Models\Proposal', 'update')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the proposal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->getRole('App\Models\Proposal', 'delete')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the proposal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return mixed
     */
    public function restore(User $user)
    {
        if ($user->getRole('App\Models\Proposal', 'restore')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the proposal.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Proposal  $proposal
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        if ($user->getRole('App\Models\Proposal', 'restore')) {
            return true;
        }
    }
}
