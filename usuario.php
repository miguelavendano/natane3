<?php
require_once('core/coneccion.php');
require_once('core/Usuario.php');
require_once('core/modeloUsuario.php');

$model = new ModelUsuarios();

if (!empty($_POST['nombreSitio'])||!empty($_POST['web_site'])||!empty($_POST['correo'])||!empty($_POST['imagenSitio'])) {	
        $usuario = new Usuario();                    
        $usuario->name = $_POST['nombreSitio'];
        $usuario->img = $_POST['imagenSitio'];	
        $usuario->web_site = $_POST['web_site'];
        $usuario->correo = $_POST['correo'];
	$model->set_usuario($usuario);
        //ModelUsuarios::set_usuario($usuario);
        
} else if (!empty($_GET['nombreSitio'])) {
	$usuario = $model->getSitioByName($_GET['nombreSitio']);
}

?>
<form action="" method="POST">
Nombre del Sitio: <input type="text" name="nombreSitio" /><br />
Imagen: <input type="text" name="imagenSitio" /><br />
Web site: <input type="text" name="web_site" /><br />
correo: <input type="text" name="correo" /><br />

<input type="submit" value="Guardar" /><br />
</form>

<form action="" method="GET">
Nombre del sitio a buscar: <input type="text" name="nombreSitio" />
<input type="submit" value="Buscar" />
</form>

<?php if (!empty($usuario)) : ?>
	Id: <?php echo $usuario->id; ?><br />
	Sitio: <?php echo $usuario->name; ?><br />	
	Img: <?php echo $usuario->img; ?><br />
	Web_Site: <?php echo $usuario->web_site; ?><br />
	correo: <?php echo $usuario->correo; ?><br />
<?php elseif (!empty($_GET['nombreSitio'])) : ?>
	No se encuentra el usuario con nombre "<?php echo $_GET['nombreSitio']; ?>"<br />
<?php endif; ?>