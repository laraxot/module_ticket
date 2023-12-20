<?php

declare(strict_types=1);

namespace Modules\Ticket\Jobs;

use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Ticket\Models\Project;
use Modules\Ticket\Models\ProjectStatus;
use Modules\Ticket\Models\ProjectUser;
use Modules\Ticket\Models\Ticket;
use Modules\Ticket\Models\TicketPriority;
use Modules\Ticket\Models\TicketStatus;
use Modules\Ticket\Models\TicketType;
use Modules\User\Models\User;
use Webmozart\Assert\Assert;

class ImportJiraTicketsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private readonly array $tickets, private readonly User $user)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->tickets && count($this->tickets)) {
            foreach ($this->tickets as $ticket) {
                $projectDetails = $ticket->fields->project;
                $ticketData = $ticket->fields;

                $project = Project::where('name', $projectDetails->name)->first();
                if (! $project) {
                    Assert::notNull($project_status_first = ProjectStatus::where('is_default', true)->first());
                    $project = Project::create([
                        'name' => $projectDetails->name,
                        'description' => __('Project imported from Jira, project key:').$projectDetails->key,
                        // 'status_id' => ProjectStatus::where('is_default', true)->first()->id,
                        'status_id' => $project_status_first->id,
                        'owner_id' => $this->user->id,
                        'ticket_prefix' => $projectDetails->key,
                    ]);

                    ProjectUser::create([
                        'project_id' => $project->id,
                        'user_id' => $this->user->id,
                        'role' => config('system.projects.affectations.roles.can_manage'),
                    ]);
                }

                Assert::notNull($ticket_status_first = TicketStatus::where('is_default', true)->first());
                Assert::notNull($ticket_type_first = TicketType::where('is_default', true)->first());
                Assert::notNull($ticket_priority_first = TicketPriority::where('is_default', true)->first());
                Ticket::create([
                    'name' => $ticketData->summary,
                    'content' => $ticketData->description ?? __('No content found in jira ticket'),
                    'owner_id' => $this->user->id,
                    // 'status_id' => TicketStatus::where('is_default', true)->first()->id,
                    'status_id' => $ticket_status_first->id,
                    'project_id' => $project->id,
                    // 'type_id' => TicketType::where('is_default', true)->first()->id,
                    'type_id' => $ticket_type_first->id,
                    // 'priority_id' => TicketPriority::where('is_default', true)->first()->id,
                    'priority_id' => $ticket_priority_first->id,
                ]);
            }

            FilamentNotification::make()
                ->title(__('Jira importation'))
                ->icon('heroicon-o-cloud-arrow-down')
                ->body(__('Jira tickets successfully imported'))
                ->sendToDatabase($this->user);
        }
    }
}
