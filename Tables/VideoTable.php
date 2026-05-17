<?php

namespace Modules\Videos\Tables;

use Modules\Videos\Models\Videos;
use Okipa\LaravelTable\Table;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use App\Tables\RowActions\DestroyRowAction;
use App\Tables\BulkActions\DestroyBulkAction;
use Okipa\LaravelTable\Formatters\DateFormatter;
use App\Contracts\Abstracts\AbstractExtendableTable;
use Auth;

class VideoTable extends AbstractExtendableTable
{
    protected function table(): Table
    {
        return Table::make()
            ->model(Videos::class)
            ->bulkActions(fn(Videos $video) => [
                (new DestroyBulkAction())
    
            ])
            ->rowActions(fn(Videos $video) => [
                new ShowRowAction(route("videos.show", $video->id)),
                new EditRowAction(route("videos.edit", $video->id)),
                (new DestroyRowAction())
                    ->when(Auth::user()->isModerator()) // kun moderatorer kan slette
             
            ]);
    }

   protected function columns(): array
    {
        return [
            Column::make('name')
                ->title('Navn')
                ->sortable()
                ->searchable(), // Søgbar på navn

            Column::make('type')
                ->title('Type')
                ->sortable()
                ->searchable(), // Søgbar på type

            Column::make('provider')
                ->title('Udbyder')
                ->sortable()
                ->searchable(), // Søgbar på provider

            Column::make('url')
                ->title('Video link')
                ->format(fn(Videos $video) => view('videos::table.video-link-modal', compact('video'))->render())
                ->searchable(), // Søgbar på URL

            Column::make('autostart')
                ->title('Autostart')
                ->format(fn(Videos $video) => $video->autostart ? 'Ja' : 'Nej')
                ->sortable(),

            Column::make('active')
                ->title('Status')
                ->format(fn(Videos $video) => $video->active ? 'Aktiv' : 'Inaktiv')
                ->sortable(),

            Column::make('sorting')
                ->title('Sortering')
                ->sortable(),

            Column::make('created_at')
                ->title('Oprettet')
                ->format(new DateFormatter('d/m/Y H:i'))
                ->sortable(),
        ];
    }


    protected function results(): array
    {
        return [];
    }
}