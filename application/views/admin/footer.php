<footer>
    <script>
        $(document).ready(function() {
            var user_table = $("#user_table").DataTable({
                "processing": true,
                lengthMenu: [5, 10, 25, 50],
                paging: true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url(); ?>admin/listUser",
                    "type": "POST",
                    "data": function(d) {}
                },
                columns: [{
                        "data": "user_id",
                        "className":"text-center",
                        title: 'User ID'
                    },
                    {
                        "data": "username",
                        "className":"text-center",
                        title: 'Username'
                    },
                ]
            });
        })
    </script>
</footer>
</body>

</html>