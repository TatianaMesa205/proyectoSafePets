<?php
// 1. INCLUIR CONTROLADORES PARA OBTENER DATOS
require_once "controller/mascotasController.php";
require_once "controller/adoptantesController.php";
require_once "controller/citasController.php";

/**
 * normalizeCount: convierte la respuesta del controller en un entero representativo.
 * Soporta: int, string numérico, array con ['total'] o [0]['total'], o lista de filas.
 */
function normalizeCount($value){
    if (is_int($value)) return $value;
    if (is_string($value) && is_numeric($value)) return (int)$value;
    if (is_array($value)) {
        // patrón: ['total' => X]
        if (isset($value['total'])) return (int)$value['total'];
        // patrón: [0 => ['total' => X]] o [0 => ['count' => X]]
        if (isset($value[0]) && is_array($value[0])) {
            foreach (['total','count','cnt','cantidad'] as $k) {
                if (isset($value[0][$k])) return (int)$value[0][$k];
            }
        }
        // Si es una lista de filas, devolver la cantidad de elementos
        return count($value);
    }
    return 0;
}

// 2. OBTENER TOTALES REALES y normalizarlos
$totalMascotasRaw = MascotasController::ctrContarMascotas();
$totalUsuariosRaw = AdoptantesController::ctrContarAdoptantes();

// Obtener todas las citas y contar solo las pendientes (uso directo del modelo si está disponible)
$totalCitasPendientesRaw = 0;

if (class_exists('CitasModel') && method_exists('CitasModel', 'mdlListarCitas')) {
    $resp = CitasModel::mdlListarCitas();
    $citasAll = [];

    // La función del modelo devuelve un arreglo tipo: ["codigo"=>"200", "listaCitas"=>[...] ]
    if (is_array($resp) && isset($resp['listaCitas']) && is_array($resp['listaCitas'])) {
        $citasAll = $resp['listaCitas'];
    } elseif (is_array($resp) && isset($resp[0]) && is_array($resp[0])) {
        // fallback por si el modelo devolviera directamente la lista
        $citasAll = $resp;
    }

    foreach ($citasAll as $c) {
        $estado = '';
        if (isset($c['estado'])) $estado = strtolower(trim((string)$c['estado']));
        elseif (isset($c['status'])) $estado = strtolower(trim((string)$c['status']));

        // Normalizar y detectar "pendiente" en varios formatos
        $isPending = false;
        if ($estado === 'pendiente' || strpos($estado, 'pend') === 0) $isPending = true;
        elseif (is_numeric($estado) && intval($estado) === 0) $isPending = true; // si en BD usas 0 para pendiente

        if ($isPending) $totalCitasPendientesRaw++;
    }
} else {
    // Fallback: usar el método genérico del controller
    $totalCitasPendientesRaw = CitasController::ctrContarCitas();
}

$totalMascotas = normalizeCount($totalMascotasRaw);
$totalUsuarios = normalizeCount($totalUsuariosRaw);
$totalCitasPendientes = is_int($totalCitasPendientesRaw) ? (int)$totalCitasPendientesRaw : normalizeCount($totalCitasPendientesRaw);
?>

<style>
    /* --- CONTENEDOR GENERAL --- */
    .admin-dashboard {
        padding: 20px 30px 40px 30px;
        background: #fef9f6;
        min-height: 100vh;
    }

    /* --- TARJETAS SUPERIORES --- */
    .stat-card {
        background: #f4e7dd;
        border: none;
        border-radius: 18px;
        color: #4b3832;
        padding: 18px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        text-decoration: none; /* Importante para enlaces */
        display: block; /* Para que el anchor ocupe todo el espacio */
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .stat-card .card-body {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .stat-card i {
        font-size: 3.2rem;
        opacity: 0.4;
    }

    .stat-card h3 {
        font-size: 2.7rem;
        font-weight: 700;
        margin-bottom: 3px;
    }

    /* --- TÍTULO DE ACCESOS RÁPIDOS --- */
    .dashboard-title {
        color: #4b3832;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 18px;
        margin-top: 25px;
    }

    /* --- BOTONES (Quick Links) --- */
    .quick-link {
        display: block;
        background: #ffffff;
        border: none;
        padding: 28px 20px;
        text-align: center;
        border-radius: 16px;
        text-decoration: none;
        color: #5c4b3b;
        font-weight: 600;
        font-size: 1.05rem;
        transition: 0.25s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.07);
    }

    .quick-link:hover {
        background: #f4e7dd;
        color: #4b3832;
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.12);
    }

    .quick-link i {
        font-size: 2.3rem;
        display: block;
        margin-bottom: 12px;
        opacity: 0.85;
    }

    /* Centrado automático de la última fila */
    .quick-row-last {
        justify-content: center;
        margin-top: 10px;
    }

</style>

<div class="admin-dashboard container-fluid">

    <div class="row mb-4 g-4">

        <div class="col-md-4">
            <a href="mascotas" class="stat-card">
                <div class="card-body">
                    <div>
                        <h3><?php echo $totalMascotas; ?></h3>
                        <p class="mb-0">Mascotas Registradas</p>
                    </div>
                    <i class="fas fa-paw"></i>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="adoptantes" class="stat-card">
                <div class="card-body">
                    <div>
                        <h3><?php echo $totalUsuarios; ?></h3>
                        <p class="mb-0">Usuarios Activos</p>
                    </div>
                    <i class="fas fa-users"></i>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="citas" class="stat-card">
                <div class="card-body">
                    <div>
                        <h3><?php echo $totalCitasPendientes; ?></h3>
                        <p class="mb-0">Citas Pendientes</p>
                    </div>
                    <i class="fas fa-calendar-check"></i>
                </div>
            </a>
        </div>

    </div>

    <h3 class="dashboard-title">Accesos Rápidos</h3>

    <div class="row g-4">

        <div class="col-md-3">
            <a href="mascotas" class="quick-link">
                <i class="fas fa-dog"></i>
                Gestionar Mascotas
            </a>
        </div>

        <div class="col-md-3">
            <a href="adoptantes" class="quick-link">
                <i class="fas fa-user-cog"></i>
                Gestionar Adoptantes
            </a>
        </div>

        <div class="col-md-3">
            <a href="adopciones" class="quick-link">
                <i class="fas fa-hand-holding-heart"></i>
                Gestión de Adopciones
            </a>
        </div>

        <div class="col-md-3">
            <a href="citas" class="quick-link">
                <i class="fas fa-calendar-alt"></i>
                Gestión de Citas
            </a>
        </div>

        <div class="col-md-3">
            <a href="vacunas" class="quick-link">
                <i class="fas fa-syringe"></i>
                Control de Vacunas
            </a>
        </div>

        <div class="col-md-3">
            <a href="vacunasMascotas" class="quick-link">
                <i class="fas fa-notes-medical"></i>
                Vacunas de la mascota
            </a>
        </div>

        <div class="col-md-3">
            <a href="publicaciones" class="quick-link">
                <i class="fas fa-bullhorn"></i>
                Publicaciones
            </a>
        </div>

        <div class="col-md-3">
            <a href="seguimientos" class="quick-link">
                <i class="fas fa-clipboard-list"></i>
                Seguimientos
            </a>
        </div>

    </div>

    <div class="row g-4 quick-row-last">

        <div class="col-md-3">
            <a href="donaciones" class="quick-link">
                <i class="fas fa-hand-holding-usd"></i>
                Gestión de Donaciones
            </a>
        </div>

        <div class="col-md-3">
            <a href="#" class="quick-link" onclick="crearAdmin()">
                <i class="fas fa-user-shield"></i>
                Crear Nuevo Admin
            </a>
        </div>

    </div>

</div>
</div> <script src="view/js/inicioAdmin.js"></script>