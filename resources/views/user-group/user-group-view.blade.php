@section('userGroup-view')

    <table id="userGroupViewTable" class="table table-responsive table-bordered table-hover">
        <input type="hidden" id="userGroupIdForView">
        <tr>
            <th>For</th>
            <td id="viewUserGroup"></td>
        </tr>
        <tr>
            <th>Name</th>
            <td id="viewUserGroupName"></td>
        </tr>
        <tr>
            <th>Description</th>
            <td id="viewUserGroupMembers"></td>
        </tr>

    </table>

    <button class="btn btn-success" onClick="editUserGroupWithClosingView()">Edit Appointment</button>
    <button class="btn btn-success" onClick="completeUserGroupWithClosingView()">Complete Appointment</button>
    <button class="btn btn-success" onClick="editUserGroupWithClosingView()">Cancel Appointment</button>

@endsection