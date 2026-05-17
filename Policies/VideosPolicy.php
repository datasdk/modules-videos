<?php

namespace Modules\Videos\Policies;

use Modules\Videos\Models\Videos;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class VideosPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {

        // Alle autentificerede brugere kan se videoer
        return $user !== null;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Videos\Models\Videos  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Videos $video)
    {
        // Hvis videoen er offentlig, kan alle se den
        if ($video->is_public) {
            return true;
        }
        
        // Ejeren kan altid se sin egen video
        if ($user->id === $video->user_id) {
            return true;
        }
        
        // Administratorer/moderatorer kan se alt
        return $user->isAdmin() || $user->isModerator();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        
       
        


        // Alle autentificerede brugere kan oprette videoer
        return $user !== null;
        
        // Alternativt: Kun specifikke brugere
        // return $user->hasPermission('create-videos');
        // eller: return $user->isPremiumUser();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Videos\Models\Videos  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Videos $video)
    {
        // Ejeren kan opdatere sin egen video
        if ($user->id === $video->user_id) {
            return true;
        }
        
        // Administratorer/moderatorer kan opdatere alle videoer
        return $user->isAdmin() || $user->isModerator();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Videos\Models\Videos  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Videos $video)
    {
        // Ejeren kan slette sin egen video
        if ($user->id === $video->user_id) {
            return true;
        }
        
        // Administratorer/moderatorer kan slette alle videoer
        return $user->isAdmin() || $user->isModerator();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Videos\Models\Videos  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Videos $video)
    { 
        // Kun administratorer kan gendanne slettede videoer
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \Modules\Videos\Models\Videos  $video
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Videos $video)
    {
        // Kun administratorer kan permanent slette
        return $user->isAdmin();
    }

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, string $ability)
    {

      
        // Administratorer har alle rettigheder
        if ($user->isAdmin()) {
            return true;
        }
        
        // Hvis du vil tillade moderatorer alle rettigheder også:
        // if ($user->isModerator()) {
        //     return true;
        // }
        
        // Returnér ikke false her - lad de individuelle metoder håndtere det
        return null;
    }
    
    /**
     * Determine whether the user can view the index page.
     * (Valgfri - ikke en standard policy metode)
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index(User $user)
    {
        
        // Samme som viewAny
        return $this->viewAny($user);
    }
}