<?php



require_once "controladores/plantilla.controlador.php";

require_once "controladores/usuarios.controlador.php";

require_once "controladores/categorias.controlador.php";

require_once "controladores/productos.controlador.php";

require_once "controladores/clientes.controlador.php";

require_once "controladores/ventas.controlador.php";

require_once "controladores/correo.controlador.php";

require_once "controladores/galeria.controlador.php";

require_once "controladores/presupuesto.controlador.php";

require_once "controladores/pisos.controlador.php";

require_once "controladores/tipodocumento.controlador.php";

require_once "controladores/proveedores.controlador.php";

require_once "controladores/compras.controlador.php";

require_once "controladores/equipos.controlador.php";

require_once "controladores/areas.controlador.php";

require_once "controladores/mantenimiento.controlador.php";

require_once "controladores/cargos.controlador.php";

 



require_once "modelos/usuarios.modelo.php";

require_once "modelos/categorias.modelo.php";

require_once "modelos/productos.modelo.php";

require_once "modelos/clientes.modelo.php";

require_once "modelos/ventas.modelo.php";

require_once "modelos/galeria.modelo.php";

require_once "modelos/presupuesto.modelo.php";

require_once "modelos/plantilla.modelo.php";

require_once "modelos/pisos.modelo.php";

require_once "modelos/tipodocumento.modelo.php";

require_once "modelos/proveedores.modelo.php";

require_once "modelos/compras.modelo.php";

require_once "modelos/equipos.modelo.php";

require_once "modelos/areas.modelo.php";

require_once "modelos/mantenimiento.modelo.php";

require_once "modelos/cargos.modelo.php";

 



$plantilla = new ControladorPlantilla();

$plantilla -> ctrPlantilla();