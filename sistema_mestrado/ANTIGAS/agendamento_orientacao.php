<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'orientador') {
    header("Location: login.php");
    exit();
}

include 'classes/Orientacao.php';
include 'includes/header.php';

$orientacao = new Orientacao();
$proximas_orientacoes = $orientacao->getProximasOrientacoes($_SESSION['usuario_id']);
?>

<h1>Agendamento de Orientação</h1>

<div class="panel panel-default">
  <div class="panel-heading">Próximas Orientações</div>
  <div class="panel-body">
    <ul class="list-group">
      <?php foreach ($proximas_orientacoes as $orientacao): ?>
      <li class="list-group-item">
        <?php echo $orientacao['data'] . ' - ' . $orientacao['descricao']; ?>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
