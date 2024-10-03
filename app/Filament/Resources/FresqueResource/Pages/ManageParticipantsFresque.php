<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use App\Models\FresqueApplication;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Collection;

class ManageParticipantsFresque extends Page
{
    use InteractsWithRecord;

    protected static string $resource = FresqueResource::class;

    protected static string $view = 'filament.pages.manage-fresque';

    public Collection $applications;

    public function getSubheading(): ?string
    {
        return $this->record->place?->name.' - '.$this->record->full_date;
    }

    public function getTitle(): string
    {
        return 'Liste des participants';
    }

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);

        $this->applications = $this->record->applications()->orderByRaw('UPPER(last_name) ASC')->get();
    }

    public function updateState(FresqueApplication $fresqueApplication, $newState): void
    {
        $fresqueApplication->update([
            'state' => $newState,
        ]);

        $this->applications = $this->record->applications()->orderByRaw('UPPER(last_name) ASC')->get();
    }
}
