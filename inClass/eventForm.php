<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">

    <title>Event Form</title>

    <style>
    .buttons {
        margin-top: 40px;
    }

    #event_time, 
    #event_date {
        margin-top: 10px;
    }


    </style>

</head>

<body>

    <header>

    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="insertEvent.php" method="POST">
                        <label for="event_name">Event Name</label>
                        <input type="text" id="event_name" class="form-control form-control-lg" name="event_name" placeholder="Event Name">

                        <label for="event_description">Event Description</label>
                        <input type="text" id="event_description" class="form-control form-control-lg" name="event_description" placeholder="Event Description">
                        <label for="event_presenter">Event Presenter</label>
                        <input type="text" id="event_presenter" class="form-control form-control-lg" name="event_presenter" placeholder="Event Presenter">
                        <label for="event_date">Event Date</label>
                        <input type="date" id="event_date" class="form-control-sm" name="event_date">
                        <label for="event_time">Event Time</label>
                        <input type="time" id="event_time" class="form-control-sm" name="event_time">
                        <div class="buttons">
                            <button class="btn btn-primary" type="submit">Submit</button> <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <footer>

    </footer>
</body>

</html>