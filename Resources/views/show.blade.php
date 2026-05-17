@extends('layouts.app')

@section('content')

<h1>{{ $video->name }}</h1>


{{-- Video iframe direkte fra URL --}}
<div class="mb-4">
    <iframe src="{{ $video->url }}" width="640" height="360" frameborder="0" allowfullscreen></iframe>
</div>

{{-- Video info --}}
<table class="table table-bordered">
    <tr>
        <th>Link</th>
        <td><a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></td>
    </tr>
    <tr>
        <th>Beskrivelse</th>
        <td>{{ $video->description }}</td>
    </tr>
    <tr>
        <th>Adgang</th>
        <td>{{ ucfirst($video->access ?? 'public') }}</td>
    </tr>

    <tr>
        <th>Kategorier</th>
        <td>{{ implode(', ', $video->categories->pluck('name')->toArray() ?? []) }}</td>
    </tr>
    <tr>
        <th>Oprettet</th>
        <td>{{ $video->created_at->format('d/m/Y H:i') }}</td>
    </tr>
    <tr>
        <th>Opdateret</th>
        <td>{{ $video->updated_at->format('d/m/Y H:i') }}</td>
    </tr>
</table>

<a href="{{ route('videos.index') }}" class="btn btn-secondary">Tilbage til Videoer</a>

@endsection
