<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use App\Notifications\FresqueUpdated;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class EditFresque extends EditRecord
{
    protected static string $resource = FresqueResource::class;

    public function getSubheading(): ?string
    {
        return $this->record->place?->name.' - '.$this->record->full_date;
    }

    public function getTitle(): string
    {
        return 'Fresque #'.$this->record->id;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        Notification::route('slack', config('services.slack.notifications.channel'))
            ->notify(new FresqueUpdated(Auth::user(), $record));

        return $record;
    }
}
