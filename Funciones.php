<?php
//CONEXION
function bbdd(){
    $conection = mysqli_connect('localhost','root','','infobdn')or die("Conexion fallida: " . mysqli_connect_error());
    return $conection;
}

function crearProfessor($conexion){
    //CONTROL CLAVES PRIMARIAS
    $dni=$_POST['dni'];
    $q="SELECT dni FROM professors WHERE dni='$dni'";
    $consult = mysqli_query($conexion, $q);
    $registros=mysqli_num_rows($consult);
    if($registros>0){
        ?><script>alert("Este DNI ya consta en la base de datos \nCreación no exitosa")</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearProfesor.php">
        <?php
    }
    else{
        if (is_uploaded_file ($_FILES['imagen']['tmp_name'])){
        $nombreDirectorio = "imagenesprofe/";
        $nombreFichero = $_FILES['imagen']['name'];
        $nombreCompleto = $nombreDirectorio . $nombreFichero;
        if (is_file($nombreCompleto))
        {
        $idUnico = time();
        $nombreFichero = $idUnico . "-" . $nombreFichero;
        }
        move_uploaded_file ($_FILES['imagen']['tmp_name'],
        $nombreDirectorio . $nombreFichero);}
        else print ("No se ha podido subir el fichero\n");

        //query
        $query= "INSERT INTO professors VALUES('".$_POST['dni']."',md5('".($_POST['passwd'])."'),'".$_POST['nom']."','".$_POST['cognoms']."','".$_POST['titol']."','".$_FILES['imagen']['name']."',1)";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Profesor creado con Exito');</script>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearProfesor.php">
        <?php
    }


}


//CREAR CURSO TRATAMIENTO DE DATOS
function crearCurso($conexion){

    $codi=$_POST['codi'];
    $nom=$_POST['nom'];
    $desc=$_POST['desc'];
    $hores=$_POST['hores'];
    $inici=$_POST['inici'];
    $fi=$_POST['fi'];
    $dni=$_POST['dni'];

    $q="SELECT codi FROM cursos WHERE codi='$codi'";
    $consult = mysqli_query($conexion, $q);
    $registros=mysqli_num_rows($consult);
    if($registros>0){
        ?><script>alert("Este codigo ya consta en la base de datos \nCreación no exitosa")</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearCurso.php">
        <?php
    }else{
        $inicidate=new DateTime($inici);
        $fidate=new DateTime($fi);

        if($inicidate<$fidate){
        //conexion bbdd


        //query
        $query= "INSERT INTO cursos VALUES('$codi','$nom','$desc','$hores','$inici','$fi','$dni',1)";
        $consulta = mysqli_query($conexion, $query);
        ?>
        <script>alert('Curso creado con éxito');</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=CrearCurso.php">
        <?php
        }
        else if($inicidate>$fidate) { ?><script>alert('La fecha de fin no puede ser más antigua \nIntroduzca de nuevo los datos');</script><?php }
        //Control FECHAS
    }
}

//ESTADO BBDD
function estado($filas){
    if($filas['ACTIU']==0){
        echo "<td> NO ACTIU </td>";
    }
    else if ($filas['ACTIU']==1){
        echo "<td> ACTIU </td>";
    }
}

//ESTADO BBDD ACTIVAR/DESACTIVAR
function estadoeditar($filas){
    if($filas['ACTIU']==0){
        ?><td><a href="EstadoProfe.php?id=<?php echo $filas['DNI'];?>"><img src="img/hide.png" style="height:20px;width:20px;"></a></td><?php
    }
    else if ($filas['ACTIU']==1){
        ?><td><a href="EstadoProfe.php?id=<?php echo $filas['DNI'];?>"><img src="img/visibility.png" style="height:20px;width:20px;"></a></td><?php
    }
}

function estadoeditarcurso($filas){
    if($filas['ACTIU']==0){
        ?><td><a href="EstadoCurso.php?id=<?php echo $filas['CODI'];?>"><img src="img/hide.png" style="height:20px;width:20px;"></a></td><?php
    }
    else if ($filas['ACTIU']==1){
        ?><td><a href="EstadoCurso.php?id=<?php echo $filas['CODI'];?>"><img src="img/visibility.png" style="height:20px;width:20px;"></a></td><?php
    }
}

//MODIFICAR ESTADO EDITAR


//MOSTRAR CURSOS
function mostrarCursos($conection){
    //Conectar con la bbdd
    $query= "SELECT * FROM cursos";

    //Enviar query
    $consult = mysqli_query($conection, $query);

    //Numero de registros
    $numeroregistros=mysqli_num_rows($consult);

    //Importante hacer un bule con el numero de registros
    for ($i=0;$i<$numeroregistros;$i++){

        //CREAR UN ARRAY ASOCIATIVO DE LA SIGUIENTE FORMA
        $filas=$consult->fetch_assoc();
        
    
        //IMPRIMIR
        echo "<tr>";
        echo "<td>" .$filas['CODI']. "</td>";
        echo "<td>" .$filas['NOM']. "</td>";
        echo "<td>" .$filas['DESCRIPCIO']. "</td>";
        echo "<td>" .$filas['HORES']. "</td>";
        $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
        echo "<td>" .$filas['INICI']. "</td>";

        $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
        echo "<td>" .$filas['FI']. "</td>";
        
        echo "<td>" .$filas['DNIPROFESSOR']. "</td>";
        estadoeditarcurso($filas);
        ?>
        <td><a href="EditarCurso2.php?id=<?php echo $filas['CODI'];?>"><img src="img/lapiz.png" style="height:20px;width:20px;"></a></td>

        <?php
        echo "</tr>";
    }
}

/*function eliminarprofe($conection){
    //Importante el isset ;_;
    if(isset($_POST['esborrar'])){
        //si el numero de checkbox marcados(con valor de dni) es superior a 0...
        if (count($_POST['eliminar'])>0){
            //Hacer implode del array $_POST
            $borrar = implode(',', $_POST['eliminar']);
            //Hacer y enviar consulta
            $query2="DELETE FROM professors WHERE DNI in ('{$borrar}')";
            $consult = mysqli_query($conection, $query2);
            //Refrescar para ver que realmente se han borrado
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarProfesor.php">
            <?php
        }
    }
}*/


//ELIMINAR PROFESOR
function eliminarprofesor($conection){
    $id=$_GET['id'];
    $query="UPDATE professors SET ACTIU=0 WHERE dni='$id'";
    $consult = mysqli_query($conection, $query);
    ?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarProf.php">
    <?php
    
}

//ELIMINAR CURSOS
function eliminarcurso($conection){
    $id=$_GET['id'];
    $query="UPDATE cursos SET ACTIU=0 WHERE codi='$id'";
    $consult = mysqli_query($conection, $query);
    ?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarCurs.php">
    <?php
}

/*function eliminarCURSO($conection){
    //Importante el isset ;_;
    if(isset($_POST['esborrar'])){
        //si el numero de checkbox marcados(con valor de dni) es superior a 0...
        if (count($_POST['eliminar'])>0){
            //Hacer implode del array $_POST
            $borrar = implode(',', $_POST['eliminar']);
            //Hacer y enviar consulta
            $query2="DELETE FROM cursos WHERE CODI in ('{$borrar}')";
            $consult = mysqli_query($conection, $query2);
            //Refrescar para ver que realmente se han borrado
            ?>
                <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EliminarCurso.php">
            <?php
        }
    }
}*/

//MOSTRAR CURSOS
function CursosProfe($conexion){
    $qry="SELECT nom FROM cursos";
    $cons = mysqli_query($conexion, $qry);

    while($valores = mysqli_fetch_array($cons)){
        echo '<option value="'.$valores['nom'].'">"'.$valores['nom'].'"</option>';  //en minusculas si no peta :( 
    }
}


//DESENCRIPTAR CODIGO CURSOS
function desencriptarcursos($codi,$conection){
    $qry="SELECT nom FROM cursos WHERE DNIPROFESSOR='$codi'";
    $cons = mysqli_query($conection, $qry);
    $code="";
                
    while($valores = mysqli_fetch_array($cons)){
        $code=$valores['nom'];  //en minusculas si no peta :( 
    }
    return $code;
}


//DNI PROFESOR
function DNIProfe($conexion){
    $qry="SELECT dni FROM professors WHERE actiu=1";
    $cons = mysqli_query($conexion, $qry);

    while($valores = mysqli_fetch_array($cons)){
        echo '<option value="'.$valores['dni'].'">'.$valores['dni'].'</option>';  
    }
}

//MODIFICAR FOTO
function modFoto($conexion){
    if(isset($_POST['edit'])){

        if (is_uploaded_file ($_FILES['imagen']['tmp_name']))
        {
            $nombreDirectorio = "imagenesprofe/";
            $nombreFichero = $_FILES['imagen']['name'];
            $nombreCompleto = $nombreDirectorio . $nombreFichero;
            if (is_file($nombreCompleto))
            {
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $nombreFichero;
            }
            move_uploaded_file ($_FILES['imagen']['tmp_name'],
            $nombreDirectorio . $nombreFichero);
        }
        else
            print ("No se ha podido subir el fichero\n");
        $query= "UPDATE professors SET FOTO='".$_FILES['imagen']['name']."' WHERE DNI='".$_SESSION['DNI']."'";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Foto actualizada con éxito');</script>
            <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
        <?php
    }    
}

//EDITAR PROFESOR
function editarProfe($conexion,$sesion,$cambiar){
    if(isset($_POST['enviar'])){
        //query
        if ($sesion && $cambiar){
        $query= "UPDATE professors SET DNI='".$_POST['dni']."',CONTRASENYA=md5('".$_POST['passwd']."'), NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."', TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Profesor editado con éxito, dni y contraseñas actualizadas');</script>
        <?php
        }

        else if ($sesion && !$cambiar){
            $query= "UPDATE professors SET DNI='".$_POST['dni']."',NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."', TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
            $consult = mysqli_query($conexion, $query);
            ?>
                <script>alert('Profesor editado con éxito, dni actualizado');</script>
            <?php
            }

        else if (!$sesion && $cambiar){
            $query= "UPDATE professors SET DNI='".$_POST['dni']."',CONTRASENYA=md5('".$_POST['passwd']."'),NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."', TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
            $consult = mysqli_query($conexion, $query);
            ?>
                <script>alert('Profesor editado con éxito, contraseña actualizada');</script>
            <?php
            }
    



        else{
            $query= "UPDATE professors SET NOM='".$_POST['nom']."', COGNOMS='".$_POST['cognoms']."',TITOL='".$_POST['titol']."' WHERE DNI='".$_SESSION['DNI']."'";
            $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Profesor editado con éxito, contraseña no actualizada');</script>
        <?php
        }
        
        }

}

//EDITAR CURSO
function editarCurso($conexion,$sesion){
    if(isset($_POST['enviar'])){
        //query
        if ($sesion){
        $query= "UPDATE cursos SET  CODI='".$_POST['CODI']."', NOM='".$_POST['NOM']."', DESCRIPCIO='".$_POST['DESCRIPCIO']."', HORES='".$_POST['HORES']."', INICI='".$_POST['INICI']."', FI='".$_POST['FI']."', DNIPROFESSOR='".$_POST['DNI']."' WHERE CODI='".$_SESSION['CODI']."'";
        $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Curso editado con éxito');</script>
        <?php
        }
        else{
            $query= "UPDATE cursos SET NOM='".$_POST['NOM']."', DESCRIPCIO='".$_POST['DESCRIPCIO']."', HORES='".$_POST['HORES']."', INICI='".$_POST['INICI']."', FI='".$_POST['FI']."', DNIPROFESSOR='".$_POST['DNI']."' WHERE CODI='".$_SESSION['CODI']."'";
            $consult = mysqli_query($conexion, $query);
        ?>
            <script>alert('Curso editado con éxito');</script>
        <?php
        }
        
        }

}

//CONTROL CLAVE PRIMARIA
function controlClavePrimaria($code,$conexion){
    $q="SELECT codi FROM cursos WHERE CODI ='$code'";
    $consult = mysqli_query($conexion, $q);
    $registros=mysqli_num_rows($consult);
    return $registros;
}

//SUBIR IMAGENES ALUMNO
function imagenalumno(){
    if (is_uploaded_file ($_FILES['imagen']['tmp_name'])){
        $nombreDirectorio = "imagenesalumno/";
        $nombreFichero = $_FILES['imagen']['name'];
        $nombreCompleto = $nombreDirectorio . $nombreFichero;
        if (is_file($nombreCompleto))
        {
        $idUnico = time();
        $nombreFichero = $idUnico . "-" . $nombreFichero;
        }
        move_uploaded_file ($_FILES['imagen']['tmp_name'],
        $nombreDirectorio . $nombreFichero);}

    else print ("No se ha podido subir el fichero\n");
}

//SUBIR ALUMNO
function subiralumno($conexion){
    $q= "INSERT INTO alumnes VALUES('".$_POST['email']."','".($_POST['dni'])."',md5('".$_POST['passwd']."'),'".$_POST['nom']."','".$_POST['cognoms']."','".$_POST['edat']."','".$_FILES['imagen']['name']."')";
    $consult = mysqli_query($conexion, $q);
}


//MOSTRAR CURSOS DISPONIBLES
function cursosdisponibles($conexion,$q,$dna){
    $consulta = mysqli_query($conexion, $q);
    $registros=mysqli_num_rows($consulta);


    for ($i=0;$i<$registros;$i++){
        $filas=$consulta->fetch_assoc();

        $qq="SELECT * FROM matricula WHERE dni_alumne='$dna' AND codi='".$filas['CODI']."'";
        $consult = mysqli_query($conexion, $qq);
        $valores=$consult->fetch_assoc();
        
        $dni=$filas['DNIPROFESSOR'];

        if(!$valores){
            $codi="";
        }
        else{
            $codi=$valores['CODI'];
        }

        
        if ($codi===$filas['CODI']){
            ?><tr class="back"><?php 
            echo "<td>" .$filas['CODI']. "</td>";
            echo "<td>" .$filas['NOM']. "</td>";
            echo "<td>" .$filas['DESCRIPCIO']. "</td>";

            nombreprofe($dni,$conexion);


            echo "<td>" .$filas['HORES']. "</td>";

            $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
            echo "<td>" .$filas['INICI']. "</td>";

            $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
            echo "<td>" .$filas['FI']. "</td>";
            ?>
            <td><a href="AltaMatricula.php?id=<?php echo $filas['CODI'];?>"><img src="img/reporte.png" style="height:20px;width:20px;"></a></td>
            <?php
            echo "</tr>";
        }
        else{
            echo "<tr>";
            echo "<td>" .$filas['CODI']. "</td>";
            echo "<td>" .$filas['NOM']. "</td>";
            echo "<td>" .$filas['DESCRIPCIO']. "</td>";

            nombreprofe($dni,$conexion);


            echo "<td>" .$filas['HORES']. "</td>";

            $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
            echo "<td>" .$filas['INICI']. "</td>";

            $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
            echo "<td>" .$filas['FI']. "</td>";
            ?>
            <td><a href="AltaMatricula.php?id=<?php echo $filas['CODI'];?>"><img src="img/reporte.png" style="height:20px;width:20px;"></a></td>
            <?php
            echo "</tr>";
        }
        }

        
    echo "</table>";
    }
    /***************************************************************** MOSTRAR NOTAS ALUMNOS ****************************************************************/
function filtro1($conexion){
    $query="SELECT * FROM alumnes WHERE email='".$_SESSION['alumne']."'";
    $consulta = mysqli_query($conexion, $query);
    while($valores = mysqli_fetch_array($consulta)){
        $dni=$valores['DNI'];  
    }
    return $dni;
}

function filtro3($q3,$nota,$conexion){
    $fechaActual = date('Y-m-d');
    $consulta = mysqli_query($conexion, $q3);
    $registros=mysqli_num_rows($consulta);
    for ($i=0;$i<$registros;$i++){
        $filas=$consulta->fetch_assoc();
        $dni=$filas['DNIPROFESSOR'];

        if($filas['FI']<$fechaActual){
            echo "<tr class='notqual'>";
            echo "<td>" .$filas['CODI']. "</td>";
            echo "<td>" .$filas['NOM']. "</td>";
            echo "<td>" .$filas['DESCRIPCIO']. "</td>";
                //Nombre del profesor
            nombreprofe($dni,$conexion);

            echo "<td>" .$filas['HORES']. "</td>";

            $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
            echo "<td>" .$filas['INICI']. "</td>";

            $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
            echo "<td>" .$filas['FI']. "</td>";

            if ($nota==NULL){
                echo "<td> No qualificada </td>";
            }
            else{
                echo "<td> $nota </td>";
            }
        }
        else{
            echo "<tr>";
            echo "<td>" .$filas['CODI']. "</td>";
            echo "<td>" .$filas['NOM']. "</td>";
            echo "<td>" .$filas['DESCRIPCIO']. "</td>";

            //Nombre del profesor
            nombreprofe($dni,$conexion);

            echo "<td>" .$filas['HORES']. "</td>";
            echo "<td>" .$filas['INICI']. "</td>";
            echo "<td>" .$filas['FI']. "</td>";
            if ($nota==NULL){
                echo "<td> No qualificada </td>";
            }
            else{
                echo "<td> $nota </td>";
            }
        }
    }
}

/***************************************************************************** BAJA ALUMNOS ******************************************************************************/
function bajaalum($conexion,$q3){
    $fechaActual = date('Y-m-d');
    $consulta = mysqli_query($conexion, $q3);
    $registros=mysqli_num_rows($consulta);
    for ($i=0;$i<$registros;$i++){
        $filas=$consulta->fetch_assoc();
        $dni=$filas['DNIPROFESSOR'];

        if($filas['FI']<$fechaActual){
        echo "<tr class='finished'>";
        echo "<td>" .$filas['CODI']. "</td>";
        echo "<td>" .$filas['NOM']. "</td>";
        echo "<td>" .$filas['DESCRIPCIO']. "</td>";
        nombreprofe($dni,$conexion);
        echo "<td>" .$filas['HORES']. "</td>";

        $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
        echo "<td>" .$filas['INICI']. "</td>";

        $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
        echo "<td>" .$filas['FI']. "</td>";
        }
        else{
            echo "<tr>";
            echo "<td>" .$filas['CODI']. "</td>";
            echo "<td>" .$filas['NOM']. "</td>";
            echo "<td>" .$filas['DESCRIPCIO']. "</td>";
            nombreprofe($dni,$conexion);
            echo "<td>" .$filas['HORES']. "</td>";

            $filas['INICI'] = date("d-m-Y", strtotime($filas['INICI']));
            echo "<td>" .$filas['INICI']. "</td>";

            $filas['FI'] = date("d-m-Y", strtotime($filas['FI']));
            echo "<td>" .$filas['FI']. "</td>";
        }
        ?>
        <td><a href="AlumnesBaixa2.php?id=<?php echo $filas['CODI'];?>"><img src="img/papelera.png" style="height:20px;width:20px;"></a></td>
        <?php
        
    }
}


/*******************************************************************************  cursos / profes activacion  *******************************************************************************/
function estadoactivar($conection,$id){
    $query2="SELECT * FROM cursos WHERE dniprofessor='$id'";
    $consult = mysqli_query($conection, $query2);
    $registros=mysqli_num_rows($consult);
    
    if($registros>0){
        $q="UPDATE cursos SET ACTIU=1 WHERE DNIPROFESSOR='$id'";
        $consult = mysqli_query($conection, $q);
        ?>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
        <?php
    }
    else{
        ?>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
        <?php
    }
}

function estadodesactivar($conection,$id){
    $query2="SELECT * FROM cursos WHERE dniprofessor='$id'";
    $consult = mysqli_query($conection, $query2);
    $registros=mysqli_num_rows($consult);
    if($registros>0){
        $q="UPDATE cursos SET ACTIU=0 WHERE DNIPROFESSOR='$id'";
        $consult = mysqli_query($conection, $q);
        ?>
        <script>alert("Alguns cursos s'han vist afectats. Asigna un profesor vàlid");</script>
        <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarCurso.php">
        <?php
    }else{
    ?>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=EditarProfe.php">
    <?php
    }
}

function nombreprofe($dni, $conexion){
    $query="SELECT * FROM professors WHERE DNI='$dni'";
    $consulta = mysqli_query($conexion, $query);
    while($valores = mysqli_fetch_array($consulta)){
        echo "<td>" .$valores['NOM']." ".$valores['COGNOMS']."</td>"; 
    }
}

function nombrealumn($name,$conexion){
    $query="SELECT * FROM alumnes WHERE EMAIL='$name'";
    $consulta = mysqli_query($conexion, $query);
    while($valores = mysqli_fetch_array($consulta)){
        echo "<td>" .$valores['NOM']." ".$valores['COGNOMS']."</td>"; 
    }
}

?>


