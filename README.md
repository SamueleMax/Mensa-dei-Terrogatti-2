# Mensa dei Terrogatti 2

## Software necessario
- Server mysql o mariadb
- Interprete PHP >8.0

## Istruzioni
*Le credenziali per il database si possono modificare nel file functions.php, riga 5*

- Creare un database chiamato mensa\_dei\_terrogatti\_2
- Utilizzare il file setup.sql per configurare il database

## Utilizzo
Dalla home del sito (index.php) si possono effettuare, se sono aperte, le ordinazioni, registrandosi con un username.

Dal pannello di controllo admin.php si possono aprire, chiudere, ed eliminare le ordinazioni, si possono visualizzare gli ordini effettuati e il costo totale, e si può generare un messaggio da inviare al bar della scuola che raccoglie automaticamente le ordinazioni uguali (ad esempio se utente1 ha ordinato un panino al salame e anche utente2 ha ordinato un panino al salame risulterà come "panini al salame: 2").

