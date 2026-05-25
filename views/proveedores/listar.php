<?php
session_start();

$mensaje = $_SESSION['mensaje'] ?? '';
$tipo_mensaje = $_SESSION['tipo_mensaje'] ?? '';
unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);

$termino = $_GET['q'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>

    <!-- CSS GLOBAL -->
    <link rel="stylesheet" href="/tiendaAbarrotes/assets/css/styles.css">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Segoe UI',sans-serif;
            background:#f5f7fa;
        }

        .navbar{
            background:linear-gradient(135deg,#667eea,#764ba2);
            color:white;
            padding:15px 30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand{
            display:flex;
            align-items:center;
            gap:15px;
            font-size:24px;
            font-weight:bold;
        }

        .btn-back{
            background:rgba(255,255,255,0.2);
            color:white;
            border:1px solid rgba(255,255,255,0.3);
            padding:8px 20px;
            border-radius:20px;
            text-decoration:none;
            transition:0.3s;
        }

        .btn-back:hover{
            background:rgba(255,255,255,0.3);
        }

        .container{
            max-width:1400px;
            margin:0 auto;
            padding:30px;
        }

        .header-section{
            background:white;
            padding:25px;
            border-radius:15px;
            margin-bottom:25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        .header-section h1{
            color:#333;
            font-size:28px;
        }

        .search-box{
            display:flex;
            gap:10px;
            align-items:center;
        }

        .search-box input{
            padding:10px 15px;
            border:2px solid #e0e0e0;
            border-radius:8px;
            min-width:280px;
        }

        .btn-add{
            padding:10px 20px;
            border:none;
            border-radius:8px;
            text-decoration:none;
            font-weight:bold;
            cursor:pointer;
            transition:0.3s;
            display:inline-block;
        }

        .btn-add:hover{
            transform:translateY(-2px);
        }

        .alert{
            padding:15px 20px;
            border-radius:10px;
            margin-bottom:20px;
            font-weight:600;
        }

        .alert-success{
            background:#d4edda;
            color:#155724;
        }

        .alert-error{
            background:#f8d7da;
            color:#721c24;
        }

        .table-container{
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        thead{
            background:linear-gradient(135deg,#667eea,#764ba2);
            color:white;
        }

        th,td{
            padding:15px;
            text-align:left;
            border-bottom:1px solid #f0f0f0;
        }

        tbody tr:hover{
            background:#f8f9fa;
        }

        .badge{
            padding:6px 12px;
            border-radius:20px;
            font-size:12px;
            font-weight:bold;
            display:inline-block;
        }

        .badge-success{
            background:#d4edda;
            color:#155724;
        }

        .btn-action{
            padding:8px 15px;
            border-radius:8px;
            text-decoration:none;
            font-size:13px;
            font-weight:bold;
            display:inline-block;
            margin:2px;
            transition:0.3s;
        }

        .btn-edit{
            background:#ffc107;
            color:#333;
        }

        .btn-delete{
            background:#dc3545;
            color:white;
        }

        .btn-action:hover{
            transform:translateY(-2px);
        }

        @media(max-width:768px){

            .header-section{
                flex-direction:column;
                align-items:stretch;
            }

            .search-box{
                flex-direction:column;
            }

            .search-box input{
                width:100%;
                min-width:unset;
            }

            table{
                display:block;
                overflow-x:auto;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <span>🏢</span>
            <span>Gestión de Proveedores</span>
        </div>

        <!-- DASHBOARD -->
        <a href="/tiendaAbarrotes/views/dashboard.php" class="btn-back">
            ← Volver al Dashboard
        </a>
    </nav>

    <div class="container">

        <div class="header-section">

            <h1>Listado de Proveedores</h1>

            <div style="display:flex;gap:15px;align-items:center;flex-wrap:wrap;">

                <!-- BUSCADOR -->
                <form action="/tiendaAbarrotes/controllers/ProveedorController.php"
                      method="GET"
                      class="search-box">

                    <input type="hidden" name="action" value="buscar">

                    <input
                        type="text"
                        name="q"
                        placeholder="Buscar por razón social, RUC o contacto..."
                        value="<?php echo htmlspecialchars($termino); ?>"
                    >

                    <button type="submit"
                            class="btn-add"
                            style="background:#667eea;color:white;">
                        🔍 Buscar
                    </button>

                </form>

                <!-- NUEVO -->
                <a href="/tiendaAbarrotes/controllers/ProveedorController.php?action=agregar"
                   class="btn-add"
                   style="background:#28a745;color:white;">
                    ➕ Nuevo Proveedor
                </a>

            </div>
        </div>

        <!-- MENSAJES -->
        <?php if(!empty($mensaje)): ?>

            <div class="alert alert-<?php echo htmlspecialchars($tipo_mensaje); ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>

        <?php endif; ?>

        <!-- BUSQUEDA POR RUC -->
        <div style="
            background:white;
            padding:20px;
            border-radius:15px;
            margin-bottom:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        ">

            <h3 style="margin-bottom:15px;color:#333;">
                🔍 Búsqueda Rápida por RUC
            </h3>

            <form action="/tiendaAbarrotes/controllers/ProveedorController.php"
                  method="GET"
                  style="display:flex;gap:10px;flex-wrap:wrap;">

                <input type="hidden" name="action" value="buscarPorRuc">

                <input
                    type="text"
                    name="ruc"
                    placeholder="Ingrese RUC (11 dígitos)"
                    pattern="[0-9]{11}"
                    maxlength="11"
                    required
                    style="
                        flex:1;
                        padding:12px;
                        border:2px solid #e0e0e0;
                        border-radius:8px;
                    "
                >

                <button type="submit"
                        class="btn-add"
                        style="background:#17a2b8;color:white;">
                    📄 Buscar por RUC
                </button>

            </form>
        </div>

        <!-- TABLA -->
        <div class="table-container">

            <?php if(!empty($proveedores) && count($proveedores)>0): ?>

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUC</th>
                            <th>Razón Social</th>
                            <th>Contacto</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($proveedores as $p): ?>

                            <tr>

                                <td>
                                    <strong>
                                        #<?php echo htmlspecialchars($p['id']); ?>
                                    </strong>
                                </td>

                                <td>
                                    <span class="badge badge-success">
                                        <?php echo htmlspecialchars($p['ruc']); ?>
                                    </span>
                                </td>

                                <td>
                                    <strong>
                                        <?php echo htmlspecialchars($p['razon_social']); ?>
                                    </strong>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($p['contacto']); ?>
                                </td>

                                <td>
                                    📞 <?php echo htmlspecialchars($p['telefono']); ?>
                                </td>

                                <td>
                                    ✉️ <?php echo htmlspecialchars($p['email']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($p['direccion']); ?>
                                </td>

                                <td>

                                    <!-- EDITAR -->
                                    <a href="/tiendaAbarrotes/controllers/ProveedorController.php?action=editar&id=<?php echo $p['id']; ?>"
                                       class="btn-action btn-edit">
                                        ✏️ Editar
                                    </a>

                                    <!-- ELIMINAR -->
                                    <a href="/tiendaAbarrotes/controllers/ProveedorController.php?action=eliminar&id=<?php echo $p['id']; ?>"
                                       class="btn-action btn-delete"
                                       onclick="return confirm('¿Está seguro de eliminar este proveedor?\n\nNOTA: Si tiene productos asociados no podrá eliminarse.')">
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

                    <h3>No se encontraron proveedores</h3>

                    <p>
                        <?php if(!empty($termino)): ?>

                            No hay resultados para
                            "<?php echo htmlspecialchars($termino); ?>"

                        <?php else: ?>

                            Comienza agregando tu primer proveedor

                        <?php endif; ?>
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</body>
</html>