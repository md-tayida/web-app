

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location EN</title>
    <link rel="stylesheet" href="f-style.css">
    <!-- cnd -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: #c1280f;
        }
    </style>
</head>

<body>
    <header class="top-location">
        <div class="back-to-start">
            <a href="index_en.php"><i class="bi bi-chevron-left"></i></a>
        </div>
       
    </header>
    <div class="header-location">
        Where will you be eating today ?
    </div>
    <div class="btn-toolbar-location" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
        <form action="menu_ramyeon_en.php" method="post">
    <button type="submit" name="location" value="Dine-In" class="btn btn-secondary-location"> <img src="img/dinein.png">
                    <h4>Dine-In</h4></button>
    <button type="submit"name="location" value="Take-Away" class="btn btn-secondary-location"> <img src="img/take-away.png">
                    <h4>Take-Away</h4></button>
</form>
        </div>
    </div>
</body>

</html>

