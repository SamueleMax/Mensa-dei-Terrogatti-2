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
            <?php
            include "functions.php";
            
            $conn = db_conn();
            
            // Generate message
            $result = $conn->query("SELECT username, items FROM orders");
            $all_items = [];
            while ($row = $result->fetch_assoc()) {
                $items = json_decode($row["items"], true);
                foreach ($items as $id=>$quantity) {
                    if (isset($all_items[$id])) {
                        $all_items[$id] += $quantity;
                    } else {
                        $all_items[$id] = $quantity;
                    }
                }
            }
            $total_price = 0;
            $stmt = prepare_get_menu_item_from_id($conn);
            foreach ($all_items as $id=>$quantity) {
                $item = get_menu_item_from_id($stmt, $id);
                menu_item($item["name"], -1, $quantity);
                $total_price += $item["price"] * $quantity;
            }
            $stmt->close();
            echo "<hr><p>Totale ordine: " . format_price($total_price) . "</p>";
            ?>
        </main>
    </body>
</html>

