@section('appointment-view')

    <table id="appointmentViewTable" class="table table-responsive table-bordered table-hover">
        <input type="hidden" id="appointmentIdForView">
        <tr>
            <th>For</th>
            <td id="viewAppointmentCustomer">Firoz Sabuz</td>
        </tr>
        <tr>
            <th>Title</th>
            <td id="viewAppointmentTitle">somehting new</td>
        </tr>
        <tr>
            <th>Status</th>
            <td id="viewAppointmentStatus">Due</td>
        </tr>
        <tr>
            <th>Start Time</th>
            <td id="viewAppointmentStarttime">Low</td>
        </tr>
        <tr>
            <th>Description</th>
            <td id="viewAppointmentDescription">lorem ipsum</td>
        </tr>

    </table>

    <button class="btn btn-success" onClick="editTaskWithClosingView()">Edit Task</button>
    <button class="btn btn-success" onClick="completeTaskWithClosingView()">Complete Task</button>
    <button class="btn btn-success" onClick="editTaskWithClosingView()">Cancel Task</button>

@endsection