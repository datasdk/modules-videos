@extends('layouts.app')

@section('actions')
    <a href="{{ route('videos.create') }}" class="btn btn-primary">Opret video</a>
@endsection

@section('content')

    <livewire:table 
        :config="Modules\Videos\Tables\VideoTable::class" 
    />

@endsection
