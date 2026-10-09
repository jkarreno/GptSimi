<?php
//Inicio la sesion 
session_start();
include("../conexion.php");
include("../funciones.php");

$mensaje='';

if(isset($_POST["hacer"]))
{
    //agregar sucursal
    if($_POST["hacer"]=='addsucursal')
    {
        mysqli_query($conn, "INSERT INTO sucursales (Zona, NumSucursal, Nombre, Direccion, Estado,Telefono, Responsable, CorreoE) 
                                            VALUES('".$_POST["zona"]."', '".$_POST["num_sucursal"]."', '".$_POST["nombre"]."', 
                                                    '".$_POST["direccion"]."', '".$_POST["estado"]."', '".$_POST["telefono"]."', 
                                                    '".$_POST["responsable"]."', '".$_POST["correoe"]."')") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego la sucursal '.$_POST["nombre"].'</div>';
    }
    //editar sucursal
    if($_POST["hacer"]=='editsucursal')
    {
        mysqli_query($conn, "UPDATE sucursales SET Zona='".$_POST["zona"]."', 
                                                    NumSucursal='".$_POST["num_sucursal"]."', 
                                                    Nombre='".$_POST["nombre"]."', 
                                                    Direccion='".$_POST["direccion"]."', 
                                                    Estado='".$_POST["estado"]."', 
                                                    Telefono='".$_POST["telefono"]."', 
                                                    Responsable='".$_POST["responsable"]."', 
                                                    CorreoE='".$_POST["correoe"]."' 
                                            WHERE Id='".$_POST["id_sucursal"]."'") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se edito la sucursal '.$_POST["nombre"].'</div>';
    }
    //eliminar sucursal
    if($_POST["hacer"]=='delsucursal')
    {
        mysqli_query($conn, "UPDATE sucursales SET Activo = 0 WHERE Id='".$_POST["id_sucursal"]."'") or die(mysqli_error($conn));

        $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se elimino la sucursal '.$_POST["nombre"].'</div>';
    }

    //importar sucursales
    
    if($_POST["hacer"]=='importarsucursal')
    {
        if($_FILES['fis']!='')
        {
            $nombre_archivo_r = time().'_'.$_FILES['fis']['name']; 

            $ext_r=explode('.', $nombre_archivo_r);

            if(is_uploaded_file($_FILES['fis']['tmp_name']))
            { 
                if(copy($_FILES['fis']['tmp_name'], './files/'.$nombre_archivo_r))
                {
                    $copyfile=1;
                }
                else
                {
                    $copyfile=2;
                }
            }
            else
            {
                $copyfile=3;
            }
        }

        if($copyfile==1)
        {
            $csv = file('./files/'.$nombre_archivo_r);
            $primera_linea = true;

        	$cuentalineas = 0; $complementos = 0; $errores = 0;
            foreach ($csv as $linea) {
                if ($primera_linea) {
                    $primera_linea = false; // Desactiva la omisión después de la primera línea
                    continue; // Salta la primera línea
                }

                $linea = str_getcsv($linea, "|");
            
                $ResEstado = mysqli_fetch_array(mysqli_query($conn, "SELECT Id FROM cat_estados WHERE Estado = '".strtoupper($linea[4])."'"));

                //comprueba si ya existe la sucursal
                $ResSucursal = mysqli_query($conn, "SELECT * FROM sucursales WHERE NumSucursal = '".$linea[0]."'");
                if(mysqli_num_rows($ResSucursal) > 0)
                {
                    mysqli_query($conn, "UPDATE sucursales SET Nombre='".$linea[3]."', 
                                                                Direccion='".$linea[7]." ".$linea[8]." ".$linea[9]." ".$linea[10]." ".$linea[11]." ".$linea[12]."', 
                                                                Estado='".$ResEstado["Id"]."', 
                                                                Telefono='".$linea[17]."', 
                                                                Activo = 1 
                                                            WHERE NumSucursal = '".$linea[0]."'") or die(mysqli_error($conn));
                }else{

                    mysqli_query($conn, "INSERT INTO sucursales (NumSucursal, Nombre, Direccion, Estado, Telefono, Activo) 
                                                            VALUES('".$linea[0]."', '".$linea[3]."', '".$linea[7]." ".$linea[8]." ".$linea[9]." ".$linea[10]." ".$linea[11]." ".$linea[12]."', 
                                                                    '".$ResEstado["Id"]."', '".$linea[17]."', '1')") or die(mysqli_error($conn));
                }
            }

            $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Se agrego el catalogo de sucursales</div>';
        }

        else
        {
            $mensaje='<div class="mesaje" id="mesaje"><i class="fas fa-thumbs-up"></i> Ocurrio un error, intente nuevamente</div>';
        }
    }
}

$cadena=$mensaje.'<div class="c100 card agc ber bff bfz">
            <h2><i class="ri-building-4-fill"></i> Sucursales</h2>
            <table id="table_sucursales" class="stripe row-border order-column nowrap">
                <thead>
                    <tr>
                        <th>Num. Sucursal</th>
                        <th>Estado</th>
                        <th>Zona</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Telefono</th>
                        <th>Responsable</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';
$ResSucursales=mysqli_query($conn, "SELECT * FROM sucursales WHERE Activo = 1");
while($RResSuc=mysqli_fetch_array($ResSucursales))
{
    $ResEstado = mysqli_fetch_array(mysqli_query($conn, "SELECT Estado FROM cat_estados WHERE Id = '".$RResSuc["Estado"]."' LIMIT 1"));

    $cadena.='      <tr>
                        <td>'.$RResSuc["NumSucursal"].'</td>
                        <td>'.$ResEstado["Estado"].'</td>
                        <td>'.$RResSuc["Zona"].'</td>
                        <td>'.$RResSuc["Nombre"].'</td>
                        <td>'.$RResSuc["Direccion"].'</td>
                        <td>'.$RResSuc["Telefono"].'</td>
                        <td>'.$RResSuc["Responsable"].'</td>
                        <td>'.(permisos($_SESSION["perfil"], 'edit.sucursal') ? '<a href="javascript:void(0)" onclick="editar_sucursal('.$RResSuc["Id"].')"><i class="fa-solid fa-pen-to-square"></i></a>' : '').'
                            '.(permisos($_SESSION["perfil"], 'delete.sucursal') ? '<a href="javascript:void(0)" onclick="eliminar_sucursal('.$RResSuc["Id"].')"><i class="fa-solid fa-trash"></i></a>' : '').'
                        </td>
                    </tr>';
}
$cadena.='      </tbody>
            </table>
        </div>';

echo $cadena;
?>
<script>
    $('#table_sucursales').DataTable({
        dom: 'Bfrtip',
        scrollX: true,
        scrollY: 600,
        buttons: [
            <?php if(permisos($_SESSION["perfil"], 'add.sucursal')): ?>
            {
                text: 'Agregar Sucursal',
                action: function ( e, dt, node, config ) {
                    agregar_sucursal();
                }
            },
            <?php endif; ?>
            <?php if(permisos($_SESSION["perfil"], 'import.sucursales')): ?>
            {
                text: 'Importar Sucursales',
                action: function ( e, dt, node, config ) {
                    importar_sucursales();
                }
            }
            <?php endif; ?>     
        ],
        paging: true,
        pageLength: 100,
    });

function agregar_sucursal(){
    abrirmodal();
    $.ajax({
				type: 'POST',
				url : 'configuracion/agregar_sucursal.php'
	}).done (function ( info ){
		$('#modal-body').html(info);
	});
}

function editar_sucursal(idsucursal){
    abrirmodal();
    $.ajax({
                type: 'POST',
                url : 'configuracion/editar_sucursal.php',
                data: { id: idsucursal }
    }).done (function ( info ){
        $('#modal-body').html(info);
    });
}

function eliminarSucursal(idsucursal) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {

        $.ajax({
            url: 'configuracion/sucursales.php',
            type: 'POST',
            data: {
                idsucursa: idsucursa,
                hacer: 'delsucursal'
            },
        });

    }
}

function importar_sucursales(){
    abrirmodal();
    $.ajax({
                type: 'POST',
                url : 'configuracion/importar_sucursales.php'
    }).done (function ( info ){
        $('#modal-body').html(info);
    });
}
</script>

<?php
//Created with human intelligence by @jkarreno 2026
//May the force be with you
//move your stars
//be prepared
?>