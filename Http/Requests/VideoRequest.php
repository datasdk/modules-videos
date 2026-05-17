<?php

namespace Modules\Videos\Http\Requests;

use Orion\Http\Requests\Request;

class VideoRequest extends Request
{
    public function storeRules() : array
    {
        return [
            //'provider' => 'required|nullable|string|max:255',
            //'type' => 'required|string|max:50',
            'name' => 'required',
            'name.*' => 'required',
            'description' => 'sometimes|nullable',
            'url' => 'required|url',
            'active' => 'sometimes|boolean',
        ];
    }

    public function updateRules() : array
    {
        return [
           // 'provider' => 'sometimes|nullable|string|max:255',
            //'type' => 'sometimes|string|max:50',
            'name' => 'sometimes',
            'name.*' => 'sometimes',
            'description' => 'sometimes|nullable',
            'url' => 'sometimes|url',
            'active' => 'sometimes|boolean',
        ];
    }

    public function messages() : array
    {
        return [
            'provider.required' => 'Udbyderen skal angives.',
            'provider.string' => 'Udbyderen skal være en tekststreng.',
            'provider.max' => 'Udbyderen må maks. være 255 tegn.',

            'type.required' => 'Type skal angives.',
            'type.string' => 'Type skal være en tekststreng.',
            'type.max' => 'Type må maks. være 50 tegn.',

            'name.required' => 'Navnet skal angives.',
            'name.string' => 'Navnet skal være en tekststreng.',
            'name.max' => 'Navnet må maks. være 255 tegn.',

            'description.string' => 'Beskrivelsen skal være en tekststreng.',

            'url.required' => 'URL skal angives.',
            'url.url' => 'URL skal være en gyldig webadresse.',

            'autostart.boolean' => 'Autostart skal være sandt eller falsk.',

            'access.required' => 'Adgangstype skal angives.',
            'access.string' => 'Adgangstype skal være en tekststreng.',
            'access.in' => 'Adgangstype skal være enten public, private eller restricted.',

            'active.boolean' => 'Aktiv skal være sandt eller falsk.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
