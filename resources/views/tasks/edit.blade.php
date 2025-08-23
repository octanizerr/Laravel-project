@extends('layouts.app')

@section('title','Edit Task')

@section('content')
  <h1 class="text-2xl font-semibold mb-4">Edit Task</h1>

  @if ($errors->any())
    <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-3">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-4 bg-white p-4 rounded-2xl shadow">
    @csrf
    @method('PUT')

    <div>
      <label class="block font-medium mb-1">Title *</label>
      <input name="title" value="{{ old('title', $task->title) }}" class="w-full px-3 py-2 rounded-xl border" required>
    </div>

    <div>
      <label class="block font-medium mb-1">Description</label>
      <textarea name="description" rows="4" class="w-full px-3 py-2 rounded-xl border">{{ old('description', $task->description) }}</textarea>
    </div>

    <div class="flex items-center gap-4">
      <div class="flex items-center gap-2">
        <input id="is_completed" type="checkbox" name="is_completed" value="1" {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
        <label for="is_completed">Completed</label>
      </div>

      <div>
        <label class="block font-medium mb-1">Due date</label>
        <input type="date" name="due_date" value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}" class="px-3 py-2 rounded-xl border">
      </div>
    </div>

    <div class="flex gap-2">
      <button class="px-4 py-2 rounded-xl bg-blue-600 text-white">Update</button>
      <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded-xl border">Cancel</a>
    </div>
  </form>
@endsection
