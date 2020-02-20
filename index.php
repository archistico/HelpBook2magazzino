<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Magazzino</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

<?php var_dump($_GET); ?>
<form>
    <!-- ********************************** OPERE NEL MOVIMENTO ****************************** -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">DETTAGLIO</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">


            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Quantità</label>
                        <!-- <input type="text" class="form-control" placeholder="Quantità" value="0" name='quantita' id='quantita'> -->
                        <input type="number" min="0" max="1000" step="1" class="form-control" placeholder="Quantità" value="1" id='quantita'>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Opera</label>
                        <select class="form-control select2" style="width: 100%;" id='lista'>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Aggiungi opera al movimento</label>
                        <input type="button" class="btn btn-primary btn-block" style="margin-right: 5px;" id="btnaggiungi" value="AGGIUNGI" />
                    </div>
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->

            <!-- TABELLA PRODOTTI -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body">


                        <table id="tabellaDettagli" class="table table-bordered table-hover order-list">
                            <thead>
                            <tr>
                                <td class="min2">#</td>
                                <td class="min5">Quantit&agrave;</td>
                                <td>Opera</td>
                                <td class="min10">Prezzo</td>
                                <td class="min10">Subtotale</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <h4>Importo Totale: <b>&euro; <span id="importoTotale"></span></b></h4>
                </div>
            </div>

        </div>
        <!-- /.box-body -->

    </div>
    <!-- /.box -->

    <input type="hidden" name="opere" value="" id="opere" />
    <input type="hidden" name="importo" value="0" id="importo" />


    <div class="form-group row m-t-md">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-block btn-primary btn-lg">INSERISCI</button>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

    // DICHIARAZIONE VARIABILI GENERALI
    var jslista = [];
    var dbLibri = [];
    var counter = 0;

    // function principale
    $(document).ready(function () {

        // Carica opere nel select
        $.ajax({
            dataType: "json",
            url: 'librijson.php',
            success: function (data) {
                for (var key in data) {
                    if (data.hasOwnProperty(key)) {
                        var item = data[key];
                        dbLibri.push({
                            "libroid": parseInt(item.lib_id),
                            "casaeditrice": (item.lib_casaeditrice),
                            "titolo": (item.lib_titolo),
                            "tipologia": item.lib_tipologia,
                            "prezzo": parseFloat(item.lib_prezzo)
                        });
                    }
                }

                var option = '';
                for (var i=0;i<dbLibri.length;i++){
                    option += '<option value="'+ dbLibri[i].libroid + '">' + dbLibri[i].casaeditrice + " - " + dbLibri[i].titolo + ' (' + dbLibri[i].tipologia + ' &euro; '+(dbLibri[i].prezzo).toFixed(2)+')' + '</option>';
                }
                $('#lista').append(option);
            }
        });

        // --------------------------------------------

        $("#btnaggiungi").on("click", function () {

            counter++;
            quantitatesto = $('#quantita').val();
            quantita = parseInt(quantitatesto);

            libroid = $("#lista").val();
            librotesto = $("#lista option:selected").text();

            //cerca il prezzo del prodotto in base all'ID
            prezzo = parseFloat(cercaPrezzo(libroid));

            if(isNaN(prezzo) || isNaN(quantita)) {
                prezzo = 0;
                quantita = 0;
            }

            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><span class="text-grigio">'+ counter + '</span></td>';
            cols += '<td><span type="text" name="quantita' + counter + '">' + quantita.toFixed(0) + '</span></td>';
            cols += '<td><span name="librotesto">' + librotesto + '</span></td>';
            cols += '<td><span type="text" name="prezzo' + counter + '">&euro; ' + prezzo.toFixed(2) + '</span></td>';
            cols += '<td><span type="text" name="subtotale' + counter + '"><strong>&euro; ' + (quantita*prezzo).toFixed(2) + '</strong></span></td>';
            cols += '<td><input type="button" class="ibtnDel btn btn-default btn-block"  value="X"></td>';
            newRow.append(cols);

            $("table.order-list").append(newRow);

            var jslibro = {
                "id": counter,
                "libroid": libroid,
                "quantita": quantita,
                "prezzo": prezzo
            };

            jslista.push(jslibro);

            // pulisce valori quantita e tracciabilità
            $('#quantita').val(1);
            //$('#sconto').val(0);

            visualizzaLista();

            // calcola il totale
            calculateGrandTotal();
        });

        // Se premo su una X della tabella
        $("table.order-list").on("click", ".ibtnDel", function (event) {
            // cancella dall'array l'oggetto selezionato da ID
            var tempID = $(this).closest("tr")[0].cells[0].textContent;
            jslista = jslista.filter(function(el) {
                return el.id != tempID;
            });
            visualizzaLista();

            // cancella la riga dalla tabella
            $(this).closest("tr").remove();

            // Ricalcola il totale
            calculateGrandTotal();
        });


    });

    function decode_utf8(s) {
        return decodeURIComponent(s);
    }

    function encode_utf8(s) {
        return encodeURIComponent(s);
    }

    // cerca prezzo
    function cercaPrezzo(id) {
        for (c = 0; c <= dbLibri.length -1; c++) {
            if(dbLibri[c].libroid == id) {
                return dbLibri[c].prezzo;
            }
        }
    }

    // visualizza lista prodotti
    function visualizzaLista() {
        // crea la lista
        var listalibri = "";

        for (index = 0; index <= jslista.length -1; index++) {
            listalibri=listalibri + " " + jslista[index].libroid;
        }

        $("#opere").val(JSON.stringify(jslista));
    }

    // Calcolo totale
    function calculateGrandTotal() {
        // Calcola da array
        var importoTotale = 0;
        for (index = 0; index <= jslista.length -1; index++) {
            importoTotale=importoTotale + jslista[index].quantita * jslista[index].prezzo;
        }
        $("#importoTotale").text(importoTotale.toFixed(2));
        $("#importo").val(importoTotale.toFixed(2));
    }

</script>
</body>
</html>

