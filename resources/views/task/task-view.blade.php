@section('task-view')

    <table id="taskViewTable" class="table table-responsive table-bordered table-hover">
        <input type="hidden" id="taskIdForView">
        <tr>
            <th>For</th>
            <td id="viewTaskCustomer"></td>
        </tr>
        <tr>
            <th>Title</th>
            <td id="viewTaskTitle"></td>
        </tr>
        <tr>
            <th>Deadline</th>
            <td id="viewTaskDeadline"></td>
        </tr>
        <tr>
            <th>Status</th>
            <td id="viewTaskStatus"></td>
        </tr>
        <tr>
            <th>Priority</th>
            <td id="viewTaskPriority"></td>
        </tr>
        <tr>
            <th>Description</th>
            <td id="viewTaskDescription"></td>
        </tr>
    </table>

    <button class="btn btn-success" id="edit-task-button" onClick="editTaskWithClosingView()">Edit Task</button>
    <button class="btn btn-success" id="complete-task-button" onClick="completeTaskWithClosingView()">Complete Task</button>
    <button class="btn btn-success" id="cancel-task-button"onClick="cancelTaskWithClosingView()">Cancel Task</button>

@endsection