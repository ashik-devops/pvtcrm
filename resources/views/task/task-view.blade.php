@section('task-view')

    <table id="taskViewTable" class="table table-responsive table-bordered table-hover">
        <input type="hidden" id="taskIdForView">
        <tr>
            <th>For</th>
            <td id="viewTaskCustomer">Firoz Sabuz</td>
        </tr>
        <tr>
            <th>Title</th>
            <td id="viewTaskTitle">somehting new</td>
        </tr>
        <tr>
            <th>Deadline</th>
            <td id="viewTaskDeadline">07/05/2017</td>
        </tr>
        <tr>
            <th>Status</th>
            <td id="viewTaskStatus">Due</td>
        </tr>
        <tr>
            <th>Priority</th>
            <td id="viewTaskPriority">Low</td>
        </tr>
        <tr>
            <th>Description</th>
            <td id="viewTaskDescription">Multisource..</td>
        </tr>
    </table>

    <button class="btn btn-success" onClick="editTaskWithClosingView()">Edit Task</button>
    <button class="btn btn-success" onClick="completeTaskWithClosingView()">Complete Task</button>
    <button class="btn btn-success" onClick="editTaskWithClosingView()">Cancel Task</button>

@endsection