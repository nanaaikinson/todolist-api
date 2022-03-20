<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(): array
  {
    return [
      "name" => ["required", "string"],
      "due_date" => ["required", "date"],
      "category" => ["required", Rule::exists("categories", "id")],
      "status" => ["nullable", Rule::in(["in-progress", "completed"])],
      "description" => ["nullable", 'string'],
    ];
  }
}
