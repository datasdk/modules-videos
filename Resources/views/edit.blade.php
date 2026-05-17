@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('videos.update', $video->id) }}">
    @csrf
    @method('PATCH')

    <table class="table">
        <tr>
            <th colspan="2">Video</th>
        </tr>

        <tr>
            <td width="150">Overskrift</td>
            <td>
                <input type="text" name="name" class="form-control" value="{{ old('name', $video->name) }}" required>
            </td>
        </tr>

        <tr>
            <td>Beskrivelse</td>
            <td>
                <textarea name="description" class="form-control" rows="5">{{ old('description', $video->description) }}</textarea>
            </td>
        </tr>

        <tr>
            <td>Link</td>
            <td>
                <input type="url" name="url" class="form-control"
                       value="{{ old('url', $video->url) }}"
                       placeholder="fx. https://www.youtube.com/watch?v=xxxx">
            </td>
        </tr>


    </table>

    {{-- Livewire SelectCategories --}}
    <table class="table">
        <tr>
            <th colspan="2">Kategorier</th>
        </tr>
        <tr>
            <td colspan="2">
                @livewire('select-categories', [
                    'selected' => old('categories', $video->categories->pluck('id')->toArray() ?? []),
                    'type' => 'videos'
                ])
            </td>
        </tr>
    </table>

    <table class="table">
        <tr>
            <th colspan="2">Adgang</th>
        </tr>
        <tr>
            <td width="150"></td>
            <td>
                <select name="access" class="form-control">
                    <option value="public" @selected(old('access', $video->access) === 'public')>Offentlig</option>
                    <option value="members" @selected(old('access', $video->access) === 'members')>Kun medlemmer</option>
                    <option value="private" @selected(old('access', $video->access) === 'private')>Privat</option>
                </select>
            </td>
        </tr>
    </table>

    <button type="submit" class="btn btn-primary">Opdater Video</button>
    <a href="{{ route('videos.index') }}" class="btn btn-secondary">Tilbage</a>
</form>

@endsection
