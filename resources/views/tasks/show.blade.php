@extends('layouts.app')

@section('title', $task->title)

@section('content')
  <div class="bg-white p-6 rounded-2xl shadow">
    <div class="flex justify-between items-start">
      <h1 class="text-2xl font-semibold">{{ $task->title }}</h1>
      <div class="space-x-2">
        <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-1 rounded-lg border">Edit</a>
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
              onsubmit="return confirm('Delete this task?')">
          @csrf
          @method('DELETE')
          <button class="px-3 py-1 rounded-lg bg-red-600 text-white">Delete</button>
        </form>
      </div>
    </div>

    <div class="mt-4 grid sm:grid-cols-2 gap-4">
      <div>
        <div class="text-slate-500 text-sm">Status</div>
        <div>
          @if($task->is_completed)
            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Completed</span>
          @else
            <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">Pending</span>
          @endif
        </div>
      </div>
      <div>
        <div class="text-slate-500 text-sm">Due date</div>
        <div>{{ optional($task->due_date)->format('Y-m-d') ?? '—' }}</div>
      </div>
    </div>

    @if($task->description)
      <div class="mt-6">
        <div class="text-slate-500 text-sm mb-1">Description</div>
        <p class="whitespace-pre-line">{{ $task->description }}</p>
      </div>
    @endif
  </div>
@endsection
