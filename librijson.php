<?php

function convertiJSON($stringa) {
    return $stringa;
}

try {

    $libri_array = [
        ['idlibro' => 1, 'titolo' => "Uno", 'casaeditrice' => 'Ew', 'prezzo' => 5, 'librotipologia' => 'Carta'],
        ['idlibro' => 2, 'titolo' => "Due", 'casaeditrice' => 'Ew', 'prezzo' => 5, 'librotipologia' => 'Carta'],
        ['idlibro' => 3, 'titolo' => "Tre", 'casaeditrice' => 'Ew', 'prezzo' => 5, 'librotipologia' => 'Carta'],
        ['idlibro' => 4, 'titolo' => "Quattro", 'casaeditrice' => 'Ew', 'prezzo' => 5, 'librotipologia' => 'Carta'],
    ];

    $listaLibri = [];

    foreach ($libri_array as $row) {

        $titolo = (strlen($row['titolo']) > 38) ? substr(convertiJSON($row['titolo']),0,35).'...' : convertiJSON($row['titolo']);
        $casaeditrice = convertiJSON($row['casaeditrice']);
        $tipologia = convertiJSON($row['librotipologia']);

        $listaLibri[] = array('lib_id' => $row['idlibro'], 'lib_casaeditrice' => $casaeditrice, 'lib_titolo' =>  $titolo, 'lib_prezzo' =>  $row['prezzo'], 'lib_tipologia' => $tipologia);
    }

    header('Content-type:application/json;charset=utf-8');
    echo json_encode($listaLibri);

} catch (PDOException $e) {
    throw new PDOException("Error  : " . $e->getMessage());
}
