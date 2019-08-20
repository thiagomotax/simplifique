<?php

     $conn=mysqli_connect("localhost","root","","bd_simplifique");

	$idCurso = $_REQUEST['curso'];

	$result = "SELECT * FROM disciplina WHERE idCurso=$idCurso ";
	$resultado = mysqli_query($conn, $result);

	while ($row = mysqli_fetch_assoc($resultado) ) {
		$dis[] = array(
			'idDisciplina'	=> $row['idDisciplina'],
			'nomeDisciplina' => utf8_encode($row['nomeDisciplina']),
		);
	}

	echo(json_encode($dis));
