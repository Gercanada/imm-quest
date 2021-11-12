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
                <tr id="1" class="gradeX">
                    <td>Trident</td>
                    <td>Internet Explorer 4.0 </td>
                    <td>Win 95+</td>
                </tr>
                <tr id="2" class="gradeC">
                    <td>Trident</td>
                    <td>Internet Explorer 5.0</td>
                    <td>Win 95+</td>
                </tr>
                <tr id="3" class="gradeA">
                    <td>Trident</td>
                    <td>Internet Explorer 5.5</td>
                    <td>Win 95+</td>
                </tr>
                <tr id="4" class="gradeA">
                    <td>Trident</td>
                    <td>Internet Explorer 6</td>
                    <td>Win 98+</td>
                </tr>
                <tr id="5" class="gradeA">
                    <td>Trident</td>
                    <td>Internet Explorer 7</td>
                    <td>Win XP SP2+</td>
                </tr>
                <tr id="6" class="gradeA">
                    <td>Trident</td>
                    <td>AOL browser (AOL desktop)</td>
                    <td>Win XP</td>
                </tr>
                <tr id="7" class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 1.0</td>
                    <td>Win 98+ / OSX.2+</td>
                </tr>
                <tr id="8" class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 1.5</td>
                    <td>Win 98+ / OSX.2+</td>
                </tr>
                <tr id="9" class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 2.0</td>
                    <td>Win 98+ / OSX.2+</td>
                </tr>
                <tr id="10" class="gradeA">
                    <td>Gecko</td>
                    <td>Firefox 3.0</td>
                    <td>Win 2k+ / OSX.3+</td>
                </tr>
                <tr id="11" class="gradeA">
                    <td>Gecko</td>
                    <td>Camino 1.0</td>
                    <td>OSX.2+</td>
                </tr>
                <tr id="12" class="gradeA">
                    <td>Gecko</td>
                    <td>Camino 1.5</td>
                    <td>OSX.3+</td>
                </tr>
                <tr id="13" class="gradeA">
                    <td>Gecko</td>
                    <td>Netscape 7.2</td>
                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                </tr>
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
