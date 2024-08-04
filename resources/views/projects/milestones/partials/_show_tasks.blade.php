<li class="listSortable mb-2" style="width: 12rem;" data-task-id="{{ $task->id }}">
    <div class="card" >
        <div class="card-body">
            <h6 class="card-title fw-bold">{{ ucfirst($task->name) }}</h6>
            <p class="card-text">{{ Str::limit($task->description, 100) }}</p>
        </div>
    </div>
</li>
