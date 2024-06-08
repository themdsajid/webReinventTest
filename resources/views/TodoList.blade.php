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
</head>

<body class="mt-5">
    <h1 style="color: rgb(42, 42, 143); margin-left: 30px;">PHP - Simple To Do List App</h1>
    <hr style="padding-bottom: 40px;">
    <form class="text-center" action="{{ route('store') }}" method="POST">
        @csrf
        <!-- Text input field -->
        <input type="text" id="data" name="task_name">
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary" style="background-color: rgb(42, 42, 143);">Add Task</button>
    </form>
    <table class="table">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Task</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>

        @foreach ($todoLists as $todoList)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $todoList->task_name }}</td>
                <td>{{ $todoList->status }}</td>
                <td>
                    <div>
                        @if ($todoList->status != 'Done')
                            <!-- Edit button to update status -->
                            <form action="{{ route('update', $todoList->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Done">
                                <button type="submit" class="btn btn-success">Mark as Done</button>
                            </form>
                        @endif

                        <form action="{{ route('delete', $todoList->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach

    </table>

</body>

</html>
