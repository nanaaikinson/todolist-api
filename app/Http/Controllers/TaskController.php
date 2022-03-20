<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends ApiController
{
  /**
   * Display a listing of the resource.
   *
   * @param Request $request
   * @return JsonResponse
   */
  public function index(Request $request): JsonResponse
  {
    $tasks = Task::all();

    return $this->dataResponse($tasks);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param StoreTaskRequest $request
   * @return JsonResponse
   */
  public function store(StoreTaskRequest $request): JsonResponse
  {
    $task = Task::create([
      "name" => $request->input("name"),
      "category_id" => $request->input("category"),
      "user_id" => $request->user()->id,
      "due_date" => $request->input("due_date"),
      "status" => $request->has("status") && $request->input("status") == "completed",
      "description" => $request->input("description")
    ]);

    return $this->successResponse("Task added successfully.", $task);
  }

  /**
   * Display the specified resource.
   *
   * @param Task $task
   * @return JsonResponse
   */
  public function show(Task $task): JsonResponse
  {
    return $this->dataResponse($task);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param StoreTaskRequest $request
   * @param Task $task
   * @return JsonResponse
   */
  public function update(StoreTaskRequest $request, Task $task): JsonResponse
  {
    $task->update([
      "name" => $request->input("name"),
      "category_id" => $request->input("category"),
      "user_id" => $request->user()->id,
      "due_date" => $request->input("due_date"),
      "status" => $request->has("status") && $request->input("status") == "completed",
      "description" => $request->input("description")
    ]);

    return $this->successResponse("Task updated successfully.", $task);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Task $task
   * @return JsonResponse
   */
  public function destroy(Task $task): JsonResponse
  {
    $task->delete();

    return $this->successResponse("Task deleted successfully");
  }
}
