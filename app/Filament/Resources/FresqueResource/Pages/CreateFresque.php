<?php

namespace App\Filament\Resources\FresqueResource\Pages;

use App\Filament\Resources\FresqueResource;
use App\Notifications\FresqueCreated;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CreateFresque extends CreateRecord
{
    protected static string $resource = FresqueResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $model = static::getModel()::create($data);

        Notification::route('slack', config('services.slack.notifications.channel'))
            ->notify(new FresqueCreated(Auth::user(), $model));

        return $model;
    }
}
