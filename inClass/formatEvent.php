<?php



// Function used to set the formatting of the dates

function setDateFormat($inYear, $inMonth) {
    
    $current_month = date("m"); //used to store the number of the current month to compare against later
    $current_year = date("Y"); //used to store the current date to compare against later
    
    //dynamically compares the incoming dates lots of big think 
    //probably would have been easier to compare off of first statement of current month and year both == to incoming. 
    if($inYear >= $current_year) { 
        if($inMonth >= $current_month && $inYear >= $current_year ) {
            if($inMonth == $current_month && $inYear == $current_year) {
                echo "currentMonth";
            }
            else {
                echo "futureMonth";
            }
        }
        else {
            if($inYear > $current_year) {
                echo "futureMonth";
            }
            else{
                echo "normal";
            }   
        }
    }
    else {
        echo "normal";
    }
}

try {
    include 'connectPDO.php'; // Conenct to my DB
    
    $stmt = $conn->prepare("SELECT event_name, event_description, event_presenter, DATE_FORMAT(event_date, '%m/%d/%Y') AS display_date, DATE_FORMAT(event_date, '%m') AS month_date, DATE_FORMAT(event_date, '%Y') AS year_date FROM wdv341_events ORDER BY event_date DESC");
    $stmt->execute();

    //ran a second DATE_FORMAT(); and assigned it to a different variable to compare against current month
    //ran a third DATE_FORMAT(); and assigned it to another variable to compare against current year
}

catch(PDOException $e) {
echo "<p>something went wrong</p>";
die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Format Event</title>

    <style>
    article {
        margin-top: 20px;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #000;
        box-shadow: 2px 4px 15px 1px #252525;

    }

    article:hover {
        transition: all .2s ease-in-out;
        transform: scale(1.01);
    }

    article h1 {
        color: #3067a3;
    }

    h3 {
        font-size: 1.15rem;
    }

    .currentMonth {
        color: red;
        font-weight: 900;
    }

    .futureMonth {
        font-style: italic;
        font-weight: 600;
        
    }

    .normal {
        color: gray;
    }

    header {
        background: #6d99c8;
        color: #ffffff;
        padding: 20px;
        margin-bottom: 10px;
    }

    .citynames {
        border-right: 1px solid #000;
    }

    .citynames ul {
        list-style: none;
    }

    footer {
        background: #6d99c8;
        color: #fff;
        height: 50px;
        padding: 10px;
    }

    footer a {
        text-decoration: none;
        color: #FFF;
    }
    
    </style>
</head>
<body>

<!-- HEADER TITLE  -->

    <header>
    <div class="container-fluid"> <!-- START: Header Container -->
        <div class="row">
            <div class="col-lg-12 text-left">
            <h1>Conferences 'R' Us</h1>
            </div>
        </div>
    </div>
    </header> <!-- END: Header Container -->
    
<!-- MAIN CONTENT  -->

    <main>
    <div class="container-fluid"> <!-- START: Main Container -->
        <div class="row"> <!-- START: Main Row -->
            <div class="col-lg-3 citynames">
            <h1>City Names</h1>
            <ul>
                <li>Ankeny</li>
                <li>Des Moines</li>
                <li>Ames</li>
            </ul>
            </div>
            <div class="col-lg-9">
                <?php 
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) // Dynamically loads each row from the database into an article element (card)
                 { 
                     ?>
                     <!-- START: Article Card -->
                    <article>
                        <div class='row'>
                            <div class='col-8'>
                                <h1><?= $row['event_name']?></h1>
                            </div>
                            <div class='col-4 text-right'>
                            <p class="<?= setDateFormat( $row['year_date'], $row['month_date'] ) ?>">
                            <?= $row['display_date']?>
                            
                            </p> 
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-12'>
                                <h2>Event Description:</h2> 
                                <p><?= $row['event_description']?></p> 
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-12 text-left'>
                            <h3>Presented By: <?= $row['event_presenter']?></h3>  
                            </div>
                        </div>
                        </article>
                        <!-- END: Article Card -->
                <?php
                 }
                ?>
            </div>
        </div> <!-- END: Main Row -->
    </div>  <!-- END: Main Container -->
    </main>
    <footer class="text-left">
    <p>&copy; <a href="http://www.willbdesigned.com">Will B. Designed <?= date("Y"); ?></p>
    </footer>
</body>
</html>