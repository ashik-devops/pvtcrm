@section('appointment-view')

    <table id="appointmentViewTable" class="table table-responsive table-bordered table-hover">
        <input type="hidden" id="appointmentIdForView">
        <tr>
            <th>For</th>
            <td id="viewAppointmentCustomer"></td>
        </tr>
        <tr>
            <th>Title</th>
            <td id="viewAppointmentTitle"></td>
        </tr>
        <tr>
            <th>Status</th>
            <td id="viewAppointmentStatus"></td>
        </tr>
        <tr>
            <th>Start Time</th>
            <td id="viewAppointmentStart_time"></td>
        </tr>
        <tr>
            <th>End Time</th>
            <td id="viewAppointmentEnd_time"></td>
        </tr>
        <tr>
            <th>Description</th>
            <td id="viewAppointmentDescription"></td>
        </tr>

    </table>

    <button class="btn btn-success" onClick="editAppointmentWithClosingView()">Edit Appointment</button>
    <button class="btn btn-success" onClick="completeAppointmentWithClosingView()">Complete Appointment</button>
    <button class="btn btn-success" onClick="editAppointmentWithClosingView()">Cancel Appointment</button>

@endsection