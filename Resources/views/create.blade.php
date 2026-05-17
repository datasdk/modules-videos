@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('videos.store') }}">
    @csrf

    <table class="table">
        <tr>
            <th colspan="2">Video</th>
        </tr>

        <tr>
            <td width="150">Overskrift</td>
            <td>
                <input type="text" name="name" class="form-control" required>
            </td>
        </tr>

        <tr>
            <td>Beskrivelse</td>
            <td>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </td>
        </tr>

        <tr>
            <td>Link</td>
            <td>
                <input type="url" name="url" class="form-control"
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
                    'selected' => old('categories', []),
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
                    <option value="public">Offentlig</option>
                    <option value="members">Kun medlemmer</option>
                    <option value="private">Privat</option>
                </select>
            </td>
        </tr>
    </table>

    <button type="submit" class="btn btn-primary">Opret Video</button>
    <a href="{{ route('videos.index') }}" class="btn btn-secondary">Tilbage</a>
</form>

@endsection
