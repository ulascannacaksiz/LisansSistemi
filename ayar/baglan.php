<?php

try {
     $db = new PDO("mysql:host=localhost;dbname=lisans", "root", "");
} catch ( PDOException $e ){
     print $e->getMessage();
}

?>
