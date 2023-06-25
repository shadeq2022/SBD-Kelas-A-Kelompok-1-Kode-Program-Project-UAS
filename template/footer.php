
</div> <!-- end container -->

    <script src="assets/js/jquery.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/jquery-3.5.1.js"></script>
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables/responsive.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable();
        } );
        $('#cart').dataTable({searching: false, paging: false, info: false});
    </script>

</body>
</html>
