<?php
session_start();

if (!$_SESSION["auth"]) {
  header("Location: ./");
}


require_once "../model/Connection.php";

require_once "../model/Room/Room.php";
require_once "../model/Room/RoomDAO.php";
require_once "../controller/RoomController.php";

require_once "../model/Interval/IntervalDAO.php";
require_once "../controller/IntervalController.php";

require_once "../model/HighSeason/HighSeason.php";
require_once "../model/HighSeason/HighSeasonDAO.php";
require_once "../controller/HighSeasonController.php";

$rooms = RoomController::get_rooms();
$interval = IntervalController::get_interval();
$high_seasons = HighSeasonController::get_all_high_seasons();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Calculadora de Pousada</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="../css/global.css">
  <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
  <header class="container">
    <h1>Painel administrativo</h1>
    <a href="./">
      <i class="fa fa-sign-out" aria-hidden="true"></i>
      Sair
    </a>
  </header>

  <main class="container">
    <section id="prices-inputs">
      <h2>Atualizar preço</h2>
      <small>Atualize o preço base para cada reserva</small>

      <div class="inputs">
        <div>
          <h3>Chalé</h3>

          <form action="./routes.php" method="post" class="price-form">
            <input type="hidden" name="action" value="update base price">
            <input type="hidden" name="type" value="1">
            <div class="input-group">
              <label for="price">Preço base</label>
              <input type="number" name="price" id="price" value="<?= $rooms[0]->getBasePrice(); ?>" placeholder="00,00" step="0.10" min="0" max="99999.99" required>
            </div>

            <button type="submit" class="btn-green">Atualizar</button>
          </form>
        </div>

        <div>
          <h3>Apartamento</h3>

          <form action="./routes.php" method="post" class="price-form">
            <input type="hidden" name="action" value="update base price">
            <input type="hidden" name="type" value="2">
            <div class="input-group">
              <label for="price">Preço base</label>
              <input type="number" name="price" id="price" value="<?= $rooms[1]->getBasePrice(); ?>" placeholder="00,00" step="0.10" min="0" max="99999.99" required>
            </div>

            <button type="submit" class="btn-green">Atualizar</button>
          </form>
        </div>
      </div>
    </section>

    <section id="interval-section">
      <h2>Intervalo de reserva</h2>
      <small>Informe em dias o intervalo em que podem ser feitas as reservas</small>

      <div>
        <form action="./routes.php" method="POST">
          <input type="hidden" name="action" value="update interval">
          <div class="input-group">
            <label for="interval">Intervalo</label>
            <div>
              <input type="number" name="interval" id="interval" value="<?= $interval ?>" step="1" min="0" placeholder="0" required>
              <span>dias</span>
            </div>
          </div>

          <button type="submit" class="btn-green">Salvar</button>
        </form>
      </div>
    </section>

    <section id="high-season">
      <h2>Alta temporada</h2>
      <small>Indique o período e preço equivalente a alta temporada</small>

      <div>
        <form action="./routes.php" method="post">
          <input type="hidden" name="action" value="add high season">
          <div class="input-group item1">
            <label for="start">Início</label>
            <input type="date" name="start" id="start" required>
          </div>

          <div class="input-group item2">
            <label for="end">Fim</label>
            <input type="date" name="end" id="end" required>
          </div>

          <div class="input-group item3">
            <label for="room-1">Preço chalé</label>
            <input type="number" name="room-1" id="room-1" value="<?= $rooms[0]->getBasePrice(); ?>" placeholder="00,00" step="0.10" min="0" max="99999.99" required>
          </div>

          <div class="input-group item4">
            <label for="room-2">Preço apartamento</label>
            <input type="number" name="room-2" id="room-2" value="<?= $rooms[1]->getBasePrice(); ?>" placeholder="00,00" step="0.10" min="0" max="99999.99" required>
          </div>

          <button type="submit" class="btn-green item5">Salvar</button>

        </form>
      </div>
    </section>

    <section>
      <h2>Tabela de altas temporadas</h2>
      <small>Todas as futuras altas temporadas cadastradas</small>

      <div>
        <table>
          <thead>
            <tr>
              <th>Início</th>
              <th>Fim</th>
              <th>Preço chalé</th>
              <th>Preço apto.</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($high_seasons as $season) { ?>
              <tr>
                <td><?= $season -> getStart() ?></td>
                <td><?= $season -> getEnd() ?></td>
                <td><?= $season -> getPriceRoom1() ?></td>
                <td><?= $season -> getPriceRoom2() ?></td>
              </tr>
            <?php } ?>

            
          </tbody>
        </table>
      </div>
    </section>
  </main>

</body>

</html>