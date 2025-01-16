<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>About e-Tasker</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <?php include "inc/header.php"; ?>
    <div class="body">
        <?php include "inc/nav.php"; ?>
        <section class="section-1 bg-white">
            <div class="container">
                <div class="d-flex justify-content-center-align-items-center flex-column text-center">
                    <h1 class="fw-bold"><span class="mr-3">About</span> <strong class="text-warning">e-</strong><span class="text-uppercase">Tasker</span></h1>
                    <p class="lead text-capitalize">your employee task management solution!</p>
                </div>
                <div class="mt-3">
                    <p class="lead">Modern, efficient and intuitive employee taks management system designed to streamline workplace productivity. Whether you're managing a small team or large workspace, <strong class="fw-bold text-warning bg-black rounded p-1">e-Tasker</strong> ensures that every task is assigned, tracked and completed with precision and clarity. Current Version is the foundation of our vision to revolutionize task management and simplify team collabiration.</p>
                    <p class="lead mt-4"><strong>Version:</strong> <span class="fw-bold h3 ml-2 align-middle">1.0.0</span></p>
                </div>

                <div class="mt-5">
                    <h1 class="fw-bold">Future Updates</h1>

                    <div class="mt-5">
                        <!-- Version 1.1.0 Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Version 1.1.0</h5>
                                <ul>
                                    <li><strong>Recurring Tasks:</strong> Allow admins to set recurring tasks for regular activities.</li>
                                    <li><strong>Custom Tags and Labels:</strong> Add tags for better task categorization.</li>
                                    <li><strong>Task Commenting:</strong> Enable communication between admins and employees directly on task pages.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Version 1.2.0 Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Version 1.2.0</h5>
                                <ul>
                                    <li><strong>Team Collaboration Tools:</strong> Introduce team chat and file-sharing options.</li>
                                    <li><strong>Advanced Reporting:</strong> Generate detailed analytics on productivity, overdue tasks, and more.</li>
                                    <li><strong>Dark Mode:</strong> Provide a user-friendly dark mode option for extended work hours.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Version 2.0.0 Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Version 2.0.0</h5>
                                <ul>
                                    <li><strong>Mobile App Integration:</strong> Launch dedicated apps for iOS and Android.</li>
                                    <li><strong>AI Task Suggestions:</strong> Use artificial intelligence to recommend task priorities based on employee workload.</li>
                                    <li><strong>Multi-Language Support:</strong> Expand accessibility with support for multiple languages.</li>
                                </ul>
                            </div>
                        </div>

                        <!-- Version 2.1.0 Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Version 2.1.0</h5>
                                <ul>
                                    <li><strong>Integration with Third-Party Tools:</strong> Connect with tools like Slack, Trello, and Google Workspace.</li>
                                    <li><strong>Gamification:</strong> Introduce a points system to motivate employees for timely task completions.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

    </div>
    </section>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>