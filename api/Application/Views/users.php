<?php

// getting all the users
$users = json_decode(file_get_contents(DOMAINLINK . 'api/users'));

?>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>API Users</title>

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css" />-->
<!--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css" />-->
    <!--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.2/css/responsive.dataTables.min.css" />-->

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .full-height {
            display: flex;
            flex-direction: column;
            flex-grow: 1;

        }

        .wrapper {
          display: flex;
          flex-direction: column;
          min-height: 100vh;
        }

        .wrapper > * {
          padding: 20px;
        }

        .page-header {
          background: #592E83;
          /*padding: 20px;*/
        }

        .page-main {
            /*padding: auto;*/
            background: #331E4D;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex-direction: row;
            flex-grow: 1;

        }

        .page-footer {
          /*padding: 20px;*/
          background: #9984D4;
        }

        .container-white-rounded  {
            flex-grow: 1;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            margin: 0 auto;
            width: 70vw;
            /*height: 60vh;*/
            max-height: 70vh;
            background-color: #ffffff;
            border: #9984D4 2px solid;
            border-radius: 8px;
            padding: 20px;
            overflow: auto;


        }
        .container-white-cornered  {
            flex-grow: 1;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            margin: 0 auto;
            width: 70vw;
            /*height: 60vh;*/
            max-height: 70vh;
            background-color: #ffffff;
            border: #9984D4 2px solid;
            /*border-radius: 8px;*/
            padding: 20px;
            overflow: auto;
        }

        .dataTables_wrapper {
            width: 100%;
        }
        #displayData {
            width: 100%;
        }


        .popup_wrapper {
            display: flex;           /* establish flex container */
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0,0,0, .6);
        }

        .popup_content {
            display: flex;
            flex-direction: column;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            padding: 20px;
            background-color: #ffffff;
            /*height: 30vh;*/
            max-height: 80vh;
            width: 30vw;
            max-width: 80vw;
            overflow: auto;
        }

    </style>
</head>

<body>

<div class="container-fluid wrapper">

	<!-- Page Header Row -->
	<div class="row page-header">
		<div class="col-md-12">
			Assessment - Users
		</div>
	</div>
	<!--/header-->

	<!-- Page Main Content Row -->
	<div class="row page-main">
		<div class="full-height col-md-12">

			<div class="container-white-cornered">

                <table class="table table-bordered table-striped" id="displayData" width="100%">
                    <thead>
                    <tr>
                        <td>Username</td>
                        <td>Password</td>
                        <td>Name</td>
                        <td>Surname</td>
                        <td>Address</td>
                        <td>Contact</td>
                        <td>Email</td>
                        <td>Gender</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->password; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->surname; ?></td>
                        <td><?php echo $user->address; ?></td>
                        <td><?php echo $user->contact_number; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->gender; ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>Username</td>
                        <td>Password</td>
                        <td>Name</td>
                        <td>Surname</td>
                        <td>Address</td>
                        <td>Contact</td>
                        <td>Email</td>
                        <td>Gender</td>
                    </tr>
                    </tfoot>
                </table>


			</div>
		</div>
	</div>
	<!--/main-->


	<!-- Page Footer Row -->
	<div class="row page-footer">
		<div class="col-md-12">
			footer
		</div>
	</div>
	<!--/footer-->

</div>

<?php include VIEWS . "_partials/new_edit_user.php"; ?>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<!--<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>-->
<!--<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>-->

<script>
    $(document).ready(function(){

        $('#displayData').dataTable({
            responsive: true,
            autoFill: true,
            // scrollY: "600px",
            scrollY: auto,
            scrollX: auto,
            // scrollY: true,
            // scrollX: true,
            // scrollX: "400px",
            scrollCollapse: true,
            paging: false,
            columnDefs: [
                { width: 100, targets: 0 }
            ],
            fixedColumns: true
        });

    });
</script>


</body>
</html>