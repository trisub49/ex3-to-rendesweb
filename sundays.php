<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Vasárnapok</title>
  </head>
  <body>
    <?php
      
      if(isset($_POST['datepicker'])) 
      {
        $picked = $_POST['datepicker'];
        if($_POST['datepicker'] > date('Y-m-d')) {
          echo 
          ' 
            <div class="d-flex justify-content-center mt-1" >
              Későbbi dátumot adtál meg a jelenleginél.
            </div>
          ';
        } else {
          echo 
          ' 
            <div class="d-flex justify-content-center mt-1" >
              A megadott dátumtól ('.$picked.') kezdve '.countSundays().' vasárnap esett elsejére.
            </div>
          ';
        }
      }
      echo 
      '
        <div class="d-flex justify-content-center mt-5" >
          <form id="askfordate" method="POST" action="sundays.php">
            <label for="datepicker">Dátum megadása:</label>
            <br>
            <input class="mt-1 mb-1" type="date" name="datepicker" />
            <br>
            <input type="submit"></input>
          </form>
        </div>
      ';

      function countSundays() {
        $picked = new DateTime($_POST['datepicker']);
        $now = new DateTime('NOW');
        $interval = $picked->diff($now);
        $counter = 0;
        $plus = 1; // miután megtalálta a ciklus az első vasárnapot, utána heteket lépked
        
        for($i = 0; $i <= $interval->days; $i += $plus) {
          $picked = $picked->add(new DateInterval('P'.$plus.'D'));
         
          if($picked->format('D') == 'Sun') {
            $plus = 7;
            if($picked->format('j') == 1) {
              $counter ++; 
            }
          }
        }
        return $counter;
      }
    ?>

  </body>
</html>