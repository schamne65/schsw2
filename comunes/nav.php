<?php

   if ($_SESSION['username']=='administracion' || $_SESSION['username']=='Juanmanuel' || $_SESSION['username']=='schswadmin' ){
     $prueba_menu='<li><a href="../prueba/tienda_nube_especial.php">Armar pedido especial</a></li>';
   } else { 
      $prueba_menu="";
   };
   

?>

<header>
    <nav id="escritorio">
        <ul class="primera_ul">
        <li><a href="../index.php" class="icon-home3">Inicio</a></li>
        <li><a href="#" role="none"class="icon-barcode abrir">Producto</a>
         <ul class="desplegable">
            <li><a href="../productos/producto_disponible.php">Producto Disponible</a></li>
            <li><a href="../productos/crear_producto.php">Crear Producto</a></li>
            <li><a href="../productos/stock_positivo.php">Ingresar Producto</a></li>
            <li><a href="../productos/stock_negativo.php">Despachar Producto</a></li>
            
            
         </ul>
        </li>
        <li><a href="#" role="none"class="icon-cart abrir">Insumos</a>
         <ul class="desplegable">
            <li><a href="../insumos/stock_disponible.php">Stock Disponible</a></li>
            <li><a href="../insumos/agregar_insumo.php">Agregar insumo</a></li>
            <li><a href="../insumos/agregar_stock.php">Stock Positivo</a></li>
            <li><a href="../insumos/descontar_stock.php">Stock Negativo</a></li>
         </ul>
        </li>
        <li><a href="../proveedores/proveedores.php" class="icon-user-tie">Proveedores</a></li>
        <li><a href="../tarea/asignar_tarea.php" class="icon-calendar">Tarea</a></li>
        <li><a href="#" class="icon-upload2 abrir">Tienda Nube</a>
        <ul class="desplegable">
            <li><a href="../prueba/despacho_tienda.php">Estado del pedido</a></li>
            <li><a href="../prueba/tienda_nube.php">Armar pedido convencional</a></li>
            <li><a href="../prueba/tienda_nube_especial.php">Armar pedido especial</a></li>
            <?php echo $prueba_menu?>
         </ul>

        </li>
        <li><a href="../usuario/logout.php" class="icon-exit">Salir</a></li>
        </ul>
    </nav>
    <button class="desplegable-menu">Menu</button>
    <nav id="celular">
        <ul class="primera_ul">
        <li><a href="../index.php" class="icon-home3">Inicio</a></li>
        <li><a href="#" role="none"class="icon-barcode abrir">Producto</a>
         <ul class="desplegable">
            <li><a href="../productos/producto_disponible.php">Producto Disponible</a></li>
            <li><a href="../productos/crear_producto.php">Crear Producto</a></li>
            <li><a href="../productos/stock_positivo.php">Ingresar Producto</a></li>
            <li><a href="../productos/stock_negativo.php">Despachar Producto</a></li>
            
            
         </ul>
        </li>
        <li><a href="#" role="none"class="icon-cart abrir">Insumos</a>
         <ul class="desplegable">
            <li><a href="../insumos/stock_disponible.php">Stock Disponible</a></li>
            <li><a href="../insumos/agregar_insumo.php">Agregar insumo</a></li>
            <li><a href="../insumos/agregar_stock.php">Stock Positivo</a></li>
            <li><a href="../insumos/descontar_stock.php">Stock Negativo</a></li>
         </ul>
        </li>
        <li><a href="../proveedores/proveedores.php" class="icon-user-tie">Proveedores</a></li>
        <li><a href="../tarea/asignar_tarea.php" class="icon-calendar">Tarea</a></li>
        <li><a href="../prueba/tienda_nube.php" class="icon-upload2">Tienda Nube
        <ul class="desplegable">
            <li><a href="../prueba/despacho_tienda.php">Estado del pedido</a></li>
            <li><a href="../prueba/tienda_nube.php">Armar pedido convencional</a></li>
            <li><a href="../prueba/tienda_nube_especial.php">Armar pedido especial</a></li>
         </ul>
        </a></li>
        <li><a href="../usuario/logout.php" class="icon-enter">Salir</a></li>
        </ul>
    </nav>
</header>