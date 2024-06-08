<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todo List</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="mt-5">
    <div class="container">
        <h1 style="color: rgb(42, 42, 143); margin-left: 30px;">PHP - Simple To Do List App</h1>
        <hr style="padding-bottom: 40px;">
        <form class="text-center" id="taskForm">
            @csrf
            <!-- Text input field -->
            <input type="text" id="task" name="task_name" required>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary" style="background-color: rgb(42, 42, 143);">Add Task</button>
        </form>
        <div id="tasks" class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todoLists as $todoList)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $todoList->task_name }}</td>
                            <td>{{ $todoList->status }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if ($todoList->status != 'Done')
                                        <!-- Edit button to update status -->
                                        <form action="{{ route('update', $todoList->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="Done">
                                            <button type="submit" class="btn btn-success">Mark as Done</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('delete', $todoList->id) }}" method="POST"  onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#taskForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Check if response.status is defined and not null
                        let status = response.status !== undefined && response.status !== null ?
                            response.status : '';

                        let newTask = '<tr><td>' + (response.id) + '</td><td>' + response
                            .task_name +
                            '</td><td>' + status +
                            '</td><td><div class="d-flex gap-2"><form action="/update/' +
                            response.id +
                            '" method="POST">@csrf @method('PATCH')<input type="hidden" name="status" value="Done"><button type="submit" class="btn btn-success">Mark as Done</button></form><form action="/delete/' +
                            response.id +
                            '" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-danger">Delete</button></form></div></td></tr>';
                        $('tbody').append(newTask);
                        $('#task').val(''); // Clear the input field
                    },
                    error: function(response) {
                        alert('No duplicate tasks should be there.');
                    }

                });
            });
        });
    </script>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this task?');
        }
    </script>
</body>

</html>
