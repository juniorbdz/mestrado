<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'aluno') {
    header("Location: login.php");
    exit();
}

include 'classes/Orientacao.php';
include 'includes/header.php';

// Instanciar classe Orientacao para buscar informações
$orientacao = new Orientacao();
$orientacoes = $orientacao->getOrientacoesByAluno($_SESSION['usuario_id']);
?>

<h1>Resposta a Orientação</h1>

<div class="panel panel-default">
  <div class="panel-heading">Orientações</div>
  <div class="panel-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Data da Orientação</th>
          <th>Próximas Orientações</th>
          <th>Resposta</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orientacoes as $orientacao): ?>
        <tr>
          <td><?php echo $orientacao['data']; ?></td>
          <td><?php echo $orientacao['proximas_orientacoes']; ?></td>
          <td>
            <form method="POST" action="responder_orientacao.php">
              <input type="hidden" name="orientacao_id" value="<?php echo $orientacao['id']; ?>">
              <textarea name="resposta" class="form-control" rows="3" placeholder="Digite sua resposta..."></textarea>
              <button type="submit" class="btn btn-primary mt-2">Enviar Resposta</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
