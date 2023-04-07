<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="save-data" action="">
                        <h3>Add user</h3>
                        <div id="form-err"></div>
                        <label class="form-label" for="fname">Enter Your First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control form-control-lg">

                        <label class="form-label" for="lname">Enter Your Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control form-control-lg">

                        <label class="form-label" for="email">Enter your Email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg">

                        <input type="submit" id="save" class="btn btn-success"></input>
                    </form>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <h2>Users</h2>

        <!-- Button trigger modal -->
        <button type="button" class="btn adduser" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add User
        </button>

        <table id="api-data-table" class="table">

            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="tbody" class="student-list">

                <!-- Show all data from database -->
                <?php include './controller/tabledata.php'; ?>

            </tbody>
        </table>
    </div>
    <br>

    <script src="./scripts/adduser.js"></script>
    <script src="./scripts/handleFormSubmission.js"></script>
    <script src="./scripts/handleDelete.js"></script>

</body>

</html>