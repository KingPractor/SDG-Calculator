<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About us</title>
  <link rel="stylesheet" href="aboutus.css">
</head>
<body>
<?php include('header.php'); ?>
<div class="about-container">
    <div class="about-header">
        <h1>Σχετικά με Εμάς</h1>
    </div>
    <div class="about-content">
        <p>
            SDG-Calculator
            <br>Οδηγίες Εγκατάστασης
            Η ιστοσελίδα έχει υλοποιηθεί με HTML, CSS και PHP. 
            Για την λειτουργία της, απαιτείται εγκατάσταση της εφαρμογής XAMPP (https://www.apachefriends.org/) η οποία περιλαμβάνει Apache Web Server.
            Αφού εγκατασταθεί η εφαρμογή κάνετε εκκίνηση της και στο XAMPP Control Panel που θα εμφανιστεί επιλέγετε το κουμπί "Start" στην Γραμμή που αντιστοιχεί στον Apache Server. 
            <br>Ακολούθως, είναι απαραίτητο να μεταφέρετε τον φάκελο "SDG-Calculator", που εμπεριέχει τον κώδικα, στον φάκελο με όνομα "htdocs" που βρίσκεται στην τοποθεσία της εγκατάστασης του XAMPP. 
            Με τις προεπιλεγμένες ρυθμίσεις εγκατάστασης η διεύθυνση του φακέλου είναι "C:\xampp\htdocs" όπου "C" το γράμμα του δίσκου που φιλοξενεί την εγκατάσταση των Windows.
            <br><br>Οδηγίες Χρήσης
            Σε έναν browser πληκτρολογείτε το URL "localhost/SDG-Calculator/index.php" που αντιστοιχεί στην αρχική σελίδα της εφαρμογής. Μπορείτε να ξεκινήσετε να εισάγετε τιμές για κάθε SDG Index Code στα προκαθορισμένα πεδία.
        </p>
        <div class="about-team">
            <h2>Η Ομάδα</h2>
            <div class="team-member">
                    <h3>20390233</h3>
                    <p>ice20390233@uniwa.gr</p>
                </div>
                <div class="team-member">
                    <h3>20390189</h3>
                    <p>ice20390189@uniwa.gr</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
