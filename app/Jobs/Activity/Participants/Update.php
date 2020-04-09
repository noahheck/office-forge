<?php

namespace App\Jobs\Activity\Participants;

use App\Activity;
use App\Activity\Participant;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class Update
{
    use Dispatchable, Queueable;

    private $activity;
    private $updatedParticipants;
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Activity $activity, $updatedParticipants, User $user)
    {
        $this->activity = $activity;
        $this->updatedParticipants = $updatedParticipants;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Participant $participantModel)
    {
        $updatedParticipants = collect($this->updatedParticipants);

        $activity = $this->activity;

        $user = $this->user;

        $allExistingParticipants = $activity->participants;

        list($participantsToLeaveAlone, $participantsToRemove) = $allExistingParticipants->partition(function($participant) use ($updatedParticipants) {
            return $updatedParticipants->contains($participant->user_id);
        });

        $userIdsToAdd = $updatedParticipants->diff($participantsToLeaveAlone->pluck('user_id'));

        if ($participantsToRemove->count() > 0) {

            $participantModel->whereIn('id', $participantsToRemove->pluck('id'))
                ->update([
                    'removed_at' => now(),
                    'removed_by' => $user->id,
                ]);
        }

        $participants = $userIdsToAdd->map(function($user_id) use($activity, $user) {

            $participant = new Participant();
            $participant->activity_id = $activity->id;
            $participant->user_id = $user_id;
            $participant->added_by = $user->id;

            return $participant;
        });

        $activity->participants()->saveMany($participants);

    }
}
