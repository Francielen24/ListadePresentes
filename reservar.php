<?php
// Conectar ao banco de dados
$host = 'localhost'; // ou o IP do seu servidor MySQL
$dbname = 'casanova'; // nome do banco de dados
$username = 'root'; // seu usuário MySQL
$password = '123456'; // sua senha MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
    exit;
}

// Receber os dados do AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $produto = isset($_POST['produto']) ? $_POST['produto'] : '';

    if (empty($nome) || empty($produto)) {
        echo "Nome ou produto não podem estar vazios.";
        exit;
    }

    // Inserir a reserva no banco de dados
    $sql = "INSERT INTO reservas (nome, produto) VALUES (:nome, :produto)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':produto', $produto);

    if ($stmt->execute()) {
        echo "Reserva registrada com sucesso!";
    } else {
        echo "Ocorreu um erro ao registrar a reserva.";
    }
}
?>
