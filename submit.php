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
                // Check if username is set
                if (isset($_POST["username"])) {
                    // Validate username
                    $username = trim($_POST["username"]);
                    if (strlen($username) > 0 && strlen($username) < 50) {
                        if (!order_exists($conn, $username)) {
                            // Get order from post where quantity > 0
                            $order_items = [];
                            foreach ($_POST as $id=>$quantity) {
                                if ($id !== "username" && $quantity > 0) {
                                    $order_items[$id] = $quantity;
                                }
                            }
                            // Check if length of order_items > 0
                            if (count($order_items) > 0) {
                                $order_json = json_encode($order_items);
                                
                                // Add order to database
                                $stmt = $conn->prepare("INSERT INTO orders (username, items) VALUES (?, ?)");
                                $stmt->bind_param("ss", $username, $order_json);
                                $stmt->execute();
                                $stmt->close();
                                // Print success message
                                success_alert("Ordine inviato con successo");
                                
                                // Print order
                                $stmt = prepare_get_menu_item_from_id($conn);
                                foreach ($order_items as $id=>$quantity) {
                                    $item = get_menu_item_from_id($stmt, $id);
                                    menu_item($item["name"], $item["price"], $quantity);
                                }
                                $stmt->close();
                            } else {
                                error_alert("Non hai selezionato nessun elemento");
                            }
                        } else {
                            // Order already exists
                            error_alert("Un ordine con questo username esiste gi&agrave;. Chiedi agli admin di annullarlo.");
                        }
                    } else {
                        error_alert("Errore: l'username dev'essere compreso tra 1 e 49 caratteri");
                    }
                } else {
                    error_alert("Errore: nessun username specificato");
                }
            } else {
                error_alert("Le ordinazioni sono chiuse");
            }
            ?>
        </main>
    </body>
</html>
