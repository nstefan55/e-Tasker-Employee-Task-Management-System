<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "DB_connection.php";
    include "app/Model/User.php";

    $users = get_all_users($conn);

?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Manage Users</title>

        <link rel="stylesheet" href="css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <input type="checkbox" id="checkbox">
        <?php include "inc/header.php" ?>
        <div class="body">
            <?php include "inc/nav.php" ?>
            <section class="section-1 bg-white">
                <h4 class="title">Manage Users <a href="add-user.php" class="btn btn-warning mx-4 text-white">Add User</a></h4>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo stripcslashes($_GET['success']); ?>
                    </div>
                <?php } ?>
                <?php if ($users != 0) { ?>
                    <table class="shadow table table-hover rounded mt-4">
                        <thead>
                            <tr class="table-warning">
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= ++$i ?></td>
                                    <td><?= $user['full_name'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['role'] ?></td>
                                    <td>
                                        <a href="edit-user.php?id=<?= $user['id'] ?>" class="btn btn-primary edit-btn ml-2 mr-3">Edit</a>
                                        <a href="delete-user.php?id=<?= $user['id'] ?>" class="btn btn-danger delete-btn">Delete</a>
                                    </td>
                                </tr>
                            <?php    } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <h3>Empty</h3>
                <?php  } ?>

            </section>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript">
            let active = document.querySelector("#navList li:nth-child(2)");
            active.classList.add("active");
        </script>
    </body>

    </html>
<?php } else {
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>