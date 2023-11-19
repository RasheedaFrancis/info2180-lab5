<?php
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

if(isset($_GET['country'])){
  $country = filter_var($_GET['country'], FILTER_SANITIZE_STRING);
  
  if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities') {
    
    $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code = countries.code  WHERE countries.name LIKE '%$country%'");
} else {
  
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
}

}



$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($results)) {
  echo "No data found for the specified country: $country";
  exit;
}

?>

<table>
    <?php if (isset($_GET['lookup']) && $_GET['lookup'] === 'cities' ): ?>
        <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['district']; ?></td>
                <td><?= $row['population']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        </tr>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= $row['name']; ?></td>
                <td><?= $row['continent']; ?></td>
                <td><?= $row['independence_year']; ?></td>
                <td><?= $row['head_of_state']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
 