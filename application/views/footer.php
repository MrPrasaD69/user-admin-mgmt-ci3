</body>
<footer>
    <script>
        $(document).ready(function(){
            var user_table = new $("#user_table").DataTable({
                // "processing":true,
                "paging":true,
                lengthMenu:[5,10,25,50],
                "serverSide":true,
                "ajax":{
                    "url":"<?php echo base_url(); ?>/user/listUser",
                    "type":"POST",
                    "data": function (d) {
                    }
                },
                columns:[
                    {
                        "data":"username", "title":"User Name", "className":"text-center"
                    },
                    {
                        "data":"status", "title":"Status", "className":"text-center"
                    }
                ]
            });
        })
        

    </script>
</footer>
</html>