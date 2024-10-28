   <?php
   $dsn = 'sqlite:housingprices.db';
   // gets first 5 from the sqlite database
   try {
       $pdo = new PDO($dsn);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       $stmt = $pdo->query("SELECT * FROM properties LIMIT 5");
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

       foreach ($results as $row) {
           print_r($row);
       }
   } catch (PDOException $e) {
       echo "Connection failed: " . $e->getMessage();
   }
   ?>