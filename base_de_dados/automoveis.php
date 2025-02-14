<?php
require_once 'config.php'; // Inclui o arquivo de configuração e conexão

// Executa a consulta para buscar os itens
$sql = "SELECT * FROM orcamento_item";
$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Venda de Itens</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            display: flex;
            align-items: center;
        }
        input[type="number"] {
            width: 60px;
            margin-right: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .no-items {
            text-align: center;
            color: #777;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h1>Itens disponíveis</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Quantidade em Estoque</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
            <th>Comprar</th>
        </tr>
        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <?php while ($item = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['descricao']; ?></td>
                    <td><?php echo $item['quantidade']; ?></td>
                    <td><?php echo number_format($item['preco_unitario'], 2, ',', '.'); ?></td>
                    <td><?php echo number_format($item['subtotal'], 2, ',', '.'); ?></td>
                    <td>
                        <form action="checkout.php" method="POST" style="margin: 0;">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="descricao" value="<?php echo $item['descricao']; ?>">
                            <input type="hidden" name="preco_unitario" value="<?php echo $item['preco_unitario']; ?>">
                            <input type="number" name="quantidade_desejada" 
                                   min="1" max="<?php echo $item['quantidade']; ?>" 
                                   value="1">
                            <button type="submit">Comprar</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-items">Nenhum item encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
