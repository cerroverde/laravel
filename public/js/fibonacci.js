
  class get_fibonacci {
    constructor() {
      this.date = new Date();
    }

    fibonacci(type){
      switch (type) {
        case 'FBMonth':
          //initialization date of his getMonth
          var firstDay = new Date(this.date.getFullYear(), this.date.getMonth(), 1);
          var lastDay = new Date(this.date.getFullYear(), this.date.getMonth() + 1, 0);

          var TMFirst = firstDay.getTime()/1000;
          var TMLast = lastDay.getTime()/1000;

        break;

        case 'FBYear':
          //initialization date of his getMonth
          var firstDay = new Date(this.date.getFullYear(), 0, 1);
          var lastDay = new Date(this.date.getFullYear(), 12, 0);

          var TMFirst = firstDay.getTime()/1000;
          var TMLast = lastDay.getTime()/1000;

        break;

        case 'FBRange':
          //initialization date of his getMonth
          var firstModel = document.getElementById('flatBG').value
          var lastModel = document.getElementById('flatED').value

          var firstDay = new Date(firstModel);
          var lastDay = new Date(lastModel);

          var TMFirst = firstDay.getTime()/1000;
          var TMLast = lastDay.getTime()/1000;

        break;

      }

      var n1 = 1, n2 = 1, aux=0, result = [type];
      while ((aux=n1+n2) < TMFirst) {
        n1=n2;
        n2=aux;
      }
      while ((aux=n1+n2) <= TMLast) {
        result[result.length] = aux;
        n1=n2;
        n2=aux;
      }
/*
      // Initialize first three
      // Fibonacci Numbers
      //var f1 = 0, f2 = 1, f3 = 1;
      //var result = [];
      while (f3 <= TMLast) {
        if (f3 >= TMFirst)
          result++;
          f1 = f2;
          f2 = f3;
          result[result.length] = f3;
          f3 = f1 + f2;
      }
*/
      this.printFB(result);

      return(result);
    }

    printFB(result){
      var hr;
      var opcion;
      var objeto = result[0];
      // cleaning before making a mess
      document.getElementById(objeto).innerHTML = '';
      if (result.length > 1 ) {
        // building table header
        document.getElementById(objeto).innerHTML = "<table id='tbl' class='table'><thead><tr><th scope='col'>#</th><th scope='col'>Fibonacci</th><th scope='col'>Human Date</th></tr></thead><tbody>";
        for (var i=1; i < result.length; i++){
          hr = new Date(result[i]*1000);
          opcion = hr.toUTCString();
          // build table guts
          var line = "<tr><th scope='row'>" + (i) + "</th><td>" + result[i] + "</td><td>" + opcion + "</td></tr>";
          document.getElementById('tbl').innerHTML += line;
        }
        // closing table
        document.getElementById('tbl').innerHTML += "</tbody></table>";
      }else {
          document.getElementById(objeto).innerHTML = 'No existe un elemento Fibonacci dentro del rango timestamp definido';
      }

    }
  }
