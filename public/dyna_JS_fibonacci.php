<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- VanillaJS.js -->
    <script src="js/vanilla.js"></script>

    <!-- Flatpicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <!-- Library -->
    <script src="js/fibonacci.js"></script>


    <meta charset="utf-8">
    <title>Fibonacci JS Test</title>
  </head>
  <body>
    <script>
    window.onload = function() {
      //fibonacci('FBMonth');
      //fibonacci('FBYear');
      classInstance = new get_fibonacci();
      classInstance.fibonacci('FBMonth');
      classInstance.fibonacci('FBYear');
    };
    </script>

    <!-- Datepicker initialization -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 mt-5">
          <div class="card">
            <div class="card-header">Selecci&oacute;n por rango</div>
            <div class="card-body">
              <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Fecha Inicio</label>

                  <div class="col-md-6">
                      <input id="flatBG" type="text" class="form-control" name="flatBG">
                  </div>
              </div>
              <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Fecha Final</label>

                  <div class="col-md-6">
                      <input id="flatED" type="text" class="form-control" name="flatED" >
                  </div>
              </div>
              <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary" onclick="classInstance.fibonacci('FBRange')">
                          Calcular
                      </button>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mt-5">
          <div id='accordion'>
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Fibonacci del mes actual
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div id="FBMonth" class="card-body">
                  <!-- resultados -->
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Fibonacci del año actual
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div id="FBYear" class="card-body">
                  <!-- resultados -->
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Fibonacci por rango
                  </button>
                </h5>
              </div>

              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div id="FBRange" class="card-body">
                  <!-- resultados -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- end row -->
    </div> <!-- end container -->

    <script type="text/javascript">
      var star = flatpickr('#flatBG');
      var end = flatpickr('#flatED');

      // flatpickr('selector', options);
      flatpickr('#flatBG',{
        dateFormat: 'Y-m-d H:i:S',
        // Enables time picker
        enableTime: true,
        // Stablish Limited Time Range
        defaultDate: "1970-01-01 00:00",
        // "single"  "single", "multiple", or "range"
        mode: "single",
      });

      flatpickr('#flatED',{
        dateFormat: 'Y-m-d H:i:S',
        // Enables time picker
        enableTime: true,
        // Stablish Limited Time Range
        defaultDate: "2046-10-20 15:30",
        // "single"  "single", "multiple", or "range"
        mode: "single",
      });
    </script>

  </body>
</html>
