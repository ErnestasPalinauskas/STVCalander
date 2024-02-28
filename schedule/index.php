<?php require_once('db-connect.php') ?>
<!DOCTYPE html>
<html lang="lt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planavimas</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <script src="/schedule/fullcalendar/lib/locales/lt.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
 
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: "Roboto", sans-serif;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        .navbar {
    width: 100%;
    height: 7%;
    background-color: rgb(25, 42, 96);
    margin-right: 2rem;
    margin-bottom: 2rem;

}

.navbarText {
    display: flex;
    justify-content: flex-end; /* Aligns items to the right */
}

.navbar a {
    margin-left: 2rem; /* Adds space between the links */
    margin-right: 2rem;
    color: white; /* Makes the text color white */
    text-decoration: none; /* Removes the underline */
}

.navbar a:hover {
    color: lightblue; /* Changes the text color to light blue when hovered */
}



    </style>
</head>


<body class="bg-light">
    <div class = "logo">
    
    
     
    <div class="navbar">
    <img src="/schedule/images/stv.png" height="40px" style="margin-left: 20px;" alt="stv">

        
        <div class="navbarText">
        <a href="https://www.w3schools.com">test1</a>
        <a href="https://www.w3schools.com">test</a>
        <a href="https://www.w3schools.com">test 3</a>

        </div>
    </div>
</body>

        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="cardt rounded-0 shadow">
                    <div class="card-header bg-gradient bg-primary text-light">
                        <h5 class="card-title">Tvarkaraščio forma</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Pavadinimas</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Aprašymas</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Nuo</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required lang="lt">
                                </div>
                                <div class="form-group mb-2"> <!-- KALENDORIAUS DATA-->
                                    <label for="end_datetime" class="control-label">Iki</label>
                                    <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required lang="lt">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Išsaugoti</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Atšaukti</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Tvarkaraščio Aprašymas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Pavadinimas</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Aprašymas</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Nuo</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Iki</dt>
                            <dd id="end" class=""></dd>
                            <dt class="text-muted">Komentaras</dt>
                            
<textarea id="myTextBox" oninput="saveText()"></textarea>
                            <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description"></textarea>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Keisti</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Ištrinti</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Uždaryti</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event Details Modal -->

    <?php
    $schedules = $conn->query("SELECT * FROM `schedule_list`");
    $sched_res = [];
    foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
        $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
        $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
        $sched_res[$row['id']] = $row;
    }
    ?>
    <?php
    if (isset($conn)) $conn->close();
    ?>
</body>
<script>
    var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'lt', // Set the language to Lithuanian
            // Other options...
        });

        calendar.render();
    });
</script>

<script src="./js/script.js"></script>

<script>
   var scheds = $.parseJSON('<?= json_encode($sched_res) ?>')

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    console.log(calendarEl);

    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'lt', // Set the language to Lithuanian
        // Other options...
    });

    calendar.render();
});
</script>

<script>
// Load any saved text when the page loads
window.onload = function() {
    var savedText = localStorage.getItem('savedText');
    if (savedText) {
        document.getElementById('myTextBox').value = savedText;
    }
}

// Save the text whenever it changes
function saveText() {
    var currentText = document.getElementById('myTextBox').value;
    localStorage.setItem('savedText', currentText);
}
</script>

</html>
