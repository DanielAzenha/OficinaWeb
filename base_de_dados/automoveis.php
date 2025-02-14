<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basededados";



$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}


$sql = "SELECT matricula, marca, modelo, data_de_aquisicao FROM Veiculo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos Disponíveis</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <h2>Lista de Veículos Disponíveis</h2>
    
    <table>
        <tr>
            <th>Matrícula</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Data de Aquisição</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['matricula']}</td>
                        <td>{$row['marca']}</td>
                        <td>{$row['modelo']}</td>
                        <td>{$row['data_de_aquisicao']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum veículo disponível.</td></tr>";
        }
        ?>
    </table>

</body>
</html>

?>
