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
            
            // Check get actions
            if (isset($_GET["action"])) {
                if ($_GET["action"] === "open") {
                    // Open orders
                    $conn->query("UPDATE statuses SET value = true WHERE status = \"orders_open\"");
                    header("Location: admin.php");
                } elseif ($_GET["action"] === "close") {
                    // Close orders
                    $conn->query("UPDATE statuses SET value = false WHERE status = \"orders_open\"");
                    header("Location: admin.php");
                } elseif ($_GET["action"] === "delete") {
                    // Delete orders
                    $conn->query("TRUNCATE TABLE orders");
                    header("Location: admin.php");
                }
            }
            
            // Print order status
            if (orders_open($conn)) {
                info_alert("Le ordinazioni sono aperte");
            } else {
                info_alert("Le ordinazioni sono chiuse");
            }
            ?>
            <!-- Open/close/delete orders button group + generate message button -->
            <div class="btn-group">
                <a class="btn btn-primary" href="admin.php?action=open">Apri ordinazioni</a>
                <a class="btn btn-primary" href="admin.php?action=close">Chiudi ordinazioni</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Elimina ordinazioni</button>
            </div>
            <div class="d-grid">
                <a class="btn btn-primary mt-2" href="generate.php">Genera messaggio</a>
            </div>
            <?php
            // Get orders
            $result = $conn->query("SELECT username, items FROM orders");
            $total_price = 0;
            $stmt = prepare_get_menu_item_from_id($conn);
            while ($row = $result->fetch_assoc()) {
                // Print order username
                $items = json_decode($row["items"], true);
                echo "<h3 class=\"mt-3\">" . $row["username"] . "</h3>";
                // Print order items
                $order_price = 0;
                foreach ($items as $id=>$quantity) {
                    $item = get_menu_item_from_id($stmt, $id);
                    menu_item($item["name"], $item["price"], $quantity);
                    $order_price += $item["price"] * $quantity;
                }
                echo "<p>Totale: " . format_price($order_price) . "</p>";
                $total_price += $order_price;
            }
            $stmt->close();
            echo "<hr><p>Totale ordine: " . format_price($total_price) . "</p>";
            ?>
            
            <!-- Delete orders confirmation modal -->
            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="deleteOrdersConfirmationModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5">Eliminare ordinazioni?</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Vuoi davvero eliminare tutte le ordinazioni?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <a href="admin.php?action=delete" class="btn btn-danger">Elimina</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        </main>
    </body>
</html>
