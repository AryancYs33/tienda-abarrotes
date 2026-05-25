<?php
session_start();

// Variables que vienen desde ReporteController:
// $totalProductos
// $totalStockBajo
// $totalUsuarios
// $totalProveedores
// $stockBajo
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reportes</title>

    <!-- CSS GLOBAL -->
    <link rel="stylesheet"
          href="/tiendaAbarrotes/assets/css/styles.css">

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
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        .header-section h1{
            color:#333;
            margin-bottom:5px;
        }

        .header-section p{
            color:#777;
        }

        .kpi-grid{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .kpi-card{
            background:white;
            border-radius:15px;
            padding:25px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
            transition:0.3s;
        }

        .kpi-card:hover{
            transform:translateY(-5px);
            box-shadow:0 8px 20px rgba(0,0,0,0.1);
        }

        .kpi-title{
            font-size:14px;
            color:#777;
            margin-bottom:10px;
        }

        .kpi-value{
            font-size:36px;
            font-weight:bold;
            color:#333;
            margin-bottom:5px;
        }

        .kpi-sub{
            font-size:12px;
            color:#999;
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

        .badge-danger{
            background:#f8d7da;
            color:#721c24;
        }

        .empty-box{
            text-align:center;
            padding:60px 20px;
            color:#999;
        }

        .empty-box .icon{
            font-size:64px;
            margin-bottom:15px;
        }

        @media(max-width:768px){

            .navbar{
                flex-direction:column;
                gap:15px;
                text-align:center;
            }

            table{
                display:block;
                overflow-x:auto;
            }

            .container{
                padding:15px;
            }
        }

    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <div class="navbar-brand">
            <span>📊</span>
            <span>Reportes del Sistema</span>
        </div>

        <a href="/tiendaAbarrotes/views/dashboard.php"
           class="btn-back">
            ← Dashboard
        </a>

    </nav>

    <div class="container">

        <!-- HEADER -->
        <div class="header-section">

            <h1>Resumen General</h1>

            <p>
                Indicadores principales de la tienda
            </p>

        </div>

        <!-- KPIs -->
        <div class="kpi-grid">

            <div class="kpi-card">

                <div class="kpi-title">
                    📦 Productos registrados
                </div>

                <div class="kpi-value">
                    <?php echo $totalProductos; ?>
                </div>

                <div class="kpi-sub">
                    Total en el catálogo
                </div>

            </div>

            <div class="kpi-card">

                <div class="kpi-title">
                    ⚠️ Productos con stock bajo
                </div>

                <div class="kpi-value">
                    <?php echo $totalStockBajo; ?>
                </div>

                <div class="kpi-sub">
                    Debajo del stock mínimo
                </div>

            </div>

            <div class="kpi-card">

                <div class="kpi-title">
                    👥 Usuarios activos
                </div>

                <div class="kpi-value">
                    <?php echo $totalUsuarios; ?>
                </div>

                <div class="kpi-sub">
                    Cuentas registradas
                </div>

            </div>

            <div class="kpi-card">

                <div class="kpi-title">
                    🏢 Proveedores registrados
                </div>

                <div class="kpi-value">
                    <?php echo $totalProveedores; ?>
                </div>

                <div class="kpi-sub">
                    Aliados comerciales
                </div>

            </div>

        </div>

        <!-- TABLA -->
        <div class="table-container">

            <?php if($totalStockBajo > 0): ?>

                <table>

                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Producto</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Stock mínimo</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach($stockBajo as $p): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($p['codigo']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($p['nombre']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($p['categoria']); ?>
                                </td>

                                <td>

                                    <span class="badge badge-danger">
                                        <?php echo $p['stock']; ?>
                                    </span>

                                </td>

                                <td>
                                    <?php echo $p['stock_minimo']; ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <div class="empty-box">

                    <div class="icon">
                        ✅
                    </div>

                    <h3>
                        No hay productos con stock bajo
                    </h3>

                    <p>
                        Todo el inventario se encuentra correcto
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>

</body>
</html>