# Setup del database
1. Le credenziali per il database si possono modificare nel file "functions.php"
2. Creare un database chiamato "mensa_dei_terrogatti_2"
3. Creare una tabella "menu" con colonne "id" (int, auto increment), "category" (varchar 255), "name" (varchar 255), "price" (int)
4. Creare una tabella "orders" con colonne "username" (varchar 255), "items" (json)
5. Creare una tabella "statuses" con colonne "status" (varchar 255), "value" (boolean)
6. Nel file "menu.sql" è contenuto il codice sql per fare il setup della tabella "menu"
