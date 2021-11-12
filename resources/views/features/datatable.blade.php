<div class="card">
    <div class="card-body">
        <h4 class="card-title">My cases</h4>
        <h6 class="card-subtitle">Just click on word which you want to change and enter</h6>
        <table class="table table-striped table-bordered" id="editable-datatable">
            <thead>
                <tr>
                    <th>Case title</th>
                    <th>Case type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cases as $case)
                <tr id="1" class="gradeX">
                    <td>{{$case->title}}</td>
                    <td>{{$case->type}} </td>
                    <td>{{$case->status}} </td>
                </tr>

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Case title</th>
                    <th>Case type</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


@section('scripts')
    <script
        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/jquery-datatables-editable/jquery.dataTables.js">
    </script>
    <script
        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/libs/datatables/media/js/jquery.dataTables.min.js">
    </script>
    <script src="/templates/theme-forest-admin-pro/main/admin-pro/dist/js//pages/datatable/custom-datatable.js"></script>
    <script
        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/tiny-editable/mindmup-editabletable.js">
    </script>
    <script
        src="/templates/theme-forest-admin-pro/main/admin-pro/src/assets/extra-libs/tiny-editable/numeric-input-example.js">
    </script>
    <script>
        $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
        $('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
        $(function() {
            $('#editable-datatable').DataTable();
        });
    </script>
@endsection

</body>

</html>
