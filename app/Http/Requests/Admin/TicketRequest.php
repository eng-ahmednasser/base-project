<?php

namespace App\Http\Requests\Admin;

use App\Models\Ticket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|string|max:100|min:3",
            "description" => "required|string|max:500|min:3",
            "finalDate" => 'required|date',
            'user' => 'required|exists:users,id',
            'status' => ['required', Rule::in(Ticket::STATUSIDS)],
        ];
    }
}
