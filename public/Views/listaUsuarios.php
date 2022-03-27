<?php
  $headers = array_keys( (array) $datos->datos[0]);
  $body = $datos->datos;
?>
<!doctype html>
<html lang="es">
  <head>
    <title><?php echo $titulo; ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>

    <div class="container">
      <h1><?php echo $titulo?></h1>
      <h3><?php echo $nombre . " " . $apellido;?></h3>

      <table class="table table-striped">
        <thead>
            <tr>
              <?php foreach($headers as $key => $head) {?>
                <th scope="col"><?php echo $head; ?></th>
              <?php } ?>
            </tr>
        </thead>
        <tbody>
          <?php foreach($body as $key => $rows) { ?>
            <tr id="<?php echo $key; ?>">
              <?php foreach($rows as $key => $value) { ?>
                <td><?php echo $value; ?></td>
              <?php } ?>
            </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
      
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>