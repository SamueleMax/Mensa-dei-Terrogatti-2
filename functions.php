<?php
function db_conn() {
    // Return a connection to the database
    try {
        $conn = new mysqli("localhost", "ninja", "ninja", "mensa_dei_terrogatti_2");
    } catch (Exception $e) {
        error_alert("Errore durante la connessione al database");
        exit();
    }
    return $conn;
}

function format_price($price) {
    // Return a price in format 100 = 1,00 €
    return number_format($price / 100, 2) . " €";
}

function orders_open($conn) {
    // Check if orders are open
    $result = $conn->query("SELECT value FROM statuses WHERE status = \"orders_open\"")->fetch_array();
    return $result[0] === "1";
}

function order_exists($conn, $username) {
    // Check if an order for the specified user already exists
    $stmt = $conn->prepare("SELECT EXISTS(SELECT items FROM orders WHERE username = ?)");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_array();
    $stmt->close();
    return $result[0] === 1;
}

function info_alert($message) {
    // Print an information alert
    echo <<<EOL
    <div class="alert alert-primary" role="alert">
        $message
    </div>
    EOL;
}

function success_alert($message) {
    // Print a success alert
    echo <<<EOL
    <div class="alert alert-success" role="alert">
        $message
    </div>
    EOL;
}

function error_alert($message) {
    // Print an error alert
    echo <<<EOL
    <div class="alert alert-danger" role="alert">
        $message
    </div>
    EOL;
}

function prepare_get_menu_item_from_id($conn) {
    // Generate a prepared statement to get an item from the menu knowing its id
    return $conn->prepare("SELECT name, price FROM menu WHERE id = ?");
}

function get_menu_item_from_id($stmt, $id) {
    // Get an item from the menu from its id
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function menu_item($name, $price, $quantity) {
    // Print a menu item formatted item: quantity (total price)
    // If price = -1 don't show it
    if ($price === -1) {
        $label = "$name: $quantity";
    } else {
        $label = "$name: $quantity (" . format_price($price * $quantity) . ")";
    }
    echo "<p>$label</p>";
}

function menu_item_selector($id, $name, $price) {
    // Print menu item label with a quantity selector (0-5)
    $label = "$name (" . format_price($price) . ")";
    echo <<<EOL
    <label for="$id">$label</label>
    <select class="form-select my-2" aria-label="Menu item quantity selector" name="$id" id="$id">
        <option value="0" selected>0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    EOL;
}
?>
