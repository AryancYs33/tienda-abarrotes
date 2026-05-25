<?php
$mensaje = $_SESSION['mensaje'] ?? '';
$tipo_mensaje = $_SESSION['tipo_mensaje'] ?? '';
unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);
$termino = $_GET['q'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>

    <!-- CSS CORREGIDO -->
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <span>📦</span>
            <span>Gestión de Productos</span>
        </div>

        <!-- DASHBOARD CORREGIDO -->
        <a href="../dashboard.php" class="btn-back">
            ← Dashboard
        </a>
    </nav>

    <div class="container">

        <div class="header-section">
            <h1>Listado de Productos</h1>

            <div style="display:flex;gap:15px;">

                <!-- BUSCADOR CORREGIDO -->
                <form action="../../controllers/ProductoController.php" method="GET" class="search-box">
                    <input type="hidden" name="action" value="buscar">

                    <input type="text"
                           name="q"
                           placeholder="Buscar..."
                           value="<?php echo htmlspecialchars($termino);?>">

                    <button type="submit"
                            style="padding:10px 20px;background:#667eea;color:white;border:none;border-radius:8px;cursor:pointer;">
                        🔍 Buscar
                    </button>
                </form>

                <!-- NUEVO PRODUCTO CORREGIDO -->
                <a href="../../controllers/ProductoController.php?action=agregar"
                   class="btn-add">
                    ➕ Nuevo Producto
                </a>

            </div>
        </div>

        <!-- BÚSQUEDA POR CÓDIGO -->
        <div style="background:white;padding:20px;border-radius:10px;margin-bottom:20px;">

            <h3 style="margin-bottom:15px;">
                🔍 Búsqueda por Código
            </h3>

            <form action="../../controllers/ProductoController.php"
                  method="GET"
                  style="display:flex;gap:10px;">

                <input type="hidden"
                       name="action"
                       value="buscarPorCodigo">

                <input type="text"
                       name="codigo"
                       placeholder="Ingrese código del producto"
                       required
                       style="flex:1;padding:12px;border:2px solid #e0e0e0;border-radius:8px;">

                <button type="submit"
                        style="padding:12px 30px;background:#17a2b8;color:white;border:none;border-radius:8px;font-weight:bold;cursor:pointer;">
                    📄 Buscar
                </button>

            </form>
        </div>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo htmlspecialchars($tipo_mensaje); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <div class="table-container">

            <?php if (!empty($productos) && count($productos) > 0): ?>

                <table>

                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
                            <th>P.Compra</th>
                            <th>P.Venta</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($productos as $p): ?>

                            <tr>

                                <td>
                                    <strong>
                                        <?php echo htmlspecialchars($p['codigo']); ?>
                                    </strong>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($p['nombre']); ?>
                                </td>

                                <td>
                                    <span class="badge badge-success">
                                        <?php echo htmlspecialchars($p['categoria']); ?>
                                    </span>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($p['proveedor_nombre'] ?? 'Sin asignar'); ?>
                                </td>

                                <td>
                                    S/ <?php echo number_format($p['precio_compra'], 2); ?>
                                </td>

                                <td>
                                    S/ <?php echo number_format($p['precio_venta'], 2); ?>
                                </td>

                                <td>

                                    <?php if ($p['stock'] < $p['stock_minimo']): ?>

                                        <span class="badge badge-warning">
                                            ⚠️ <?php echo $p['stock']; ?>
                                        </span>

                                    <?php else: ?>

                                        <?php echo $p['stock']; ?>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <!-- EDITAR CORREGIDO -->
                                    <a href="../../controllers/ProductoController.php?action=editar&id=<?php echo $p['id']; ?>"
                                       class="btn-action btn-edit">
                                        ✏️ Editar
                                    </a>

                                    <!-- ELIMINAR CORREGIDO -->
                                    <a href="../../controllers/ProductoController.php?action=eliminar&id=<?php echo $p['id']; ?>"
                                       class="btn-action btn-delete"
                                       onclick="return confirm('¿Eliminar?')">
                                        🗑️ Eliminar
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div style="text-align:center;padding:60px 20px;color:#999;">

                    <div style="font-size:64px;margin-bottom:20px;">
                        📭
                    </div>

                    <h3>No se encontraron productos</h3>

                </div>

            <?php endif; ?>

        </div>

    </div>

</body>
</html>