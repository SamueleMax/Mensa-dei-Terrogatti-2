<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mensa dei Terrogatti 2</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <main class="container my-3">
            <h1>Mensa dei Terrogatti 2</h1>
            <?php
            include "functions.php";
            
            $conn = db_conn();
            
            // Check if orders are open
            if (orders_open($conn)) {
                // Open form, print menu, close form
                echo <<<EOL
                <form action="submit.php" method="post">
                    <label for="username">Username</label>
                    <input type="text" class="form-control my-2" id="username" name="username">
                EOL;
                // Print menu
                $result = $conn->query("SELECT id, category, name, price FROM menu ORDER BY category");
                $last_category = "";
                while ($row = $result->fetch_assoc()) {
                    if ($last_category !== $row["category"]) {
                        echo "<h3 class=\"my-3\">" . $row["category"] . "</h3>";
                        $last_category = $row["category"];
                    }
                    menu_item_selector($row["id"], $row["name"], $row["price"]);
                }
                echo <<<EOL
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Invia</button>
                </div>
                </form>
                EOL;
            } else {
                // Show message that orders are closed
                info_alert("Le ordinazioni sono chiuse");
            }
            ?>
        </main>
    </body>
</html>
