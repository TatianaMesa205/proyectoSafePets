<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Safe Pets</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="vista/img/paw.png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background: url('vista/img/pets-background.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            /* Updated gradient colors to warm orange/amber theme for pet adoption */
            background: linear-gradient(135deg, rgba(251, 146, 60, 0.9) 0%, rgba(245, 101, 101, 0.9) 100%);
            z-index: 0;
        }
        
        .container {
            position: relative;
            z-index: 1;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.3);
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
        }
        
        .card-header {
            /* Updated header gradient to warm pet-friendly colors */
            background: linear-gradient(to right, #f59e0b, #ea580c);
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 2px solid #e9ecef;
            background-color: rgba(255, 255, 255, 0.9);
        }
        
        .form-control:focus {
            /* Updated focus color to match pet theme */
            border-color: #f59e0b;
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
            background-color: #ffffff;
        }
        
        .btn-primary {
            /* Updated button gradient to match pet theme */
            background: linear-gradient(to right, #f59e0b, #ea580c);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            /* Updated hover gradient */
            background: linear-gradient(to right, #ea580c, #f59e0b);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(0,0,0,0.2), 0 3px 6px rgba(0,0,0,0.1);
        }
        
        .card-body {
            padding: 40px;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
        }
        
        .text-muted {
            font-size: 0.9rem;
        }
        
        .invalid-feedback {
            font-size: 0.85rem;
        }
        
        .card-header h2 {
            font-size: 2rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        
        .opacity-75 {
            font-size: 1.1rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-white text-center py-4">
                        <h2 class="mb-0">
                            <!-- Changed icon from wallet to paw and updated title -->
                            <i class="fas fa-paw me-2"></i>Safe Pets
                        </h2>
                        <!-- Updated subtitle for pet adoption foundation -->
                        <p class="mb-0 mt-2 opacity-75">Fundación de Adopción de Animales</p>
                    </div>
                    <div class="card-body">
                        <form method="post" id="formLogin" class="needs-validation" novalidate>
                            <div class="mb-4">
                                <label for="nombre_usuario" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nombre de Usuario
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="nombre_usuario" 
                                       name="nombre_usuario" 
                                       placeholder="Ingrese su usuario"
                                       required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su nombre de usuario.
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="contrasena" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Contraseña
                                </label>
                                <input type="password" 
                                       class="form-control form-control-lg" 
                                       id="contrasena" 
                                       name="contrasena" 
                                       placeholder="Ingrese su contraseña"
                                       required>
                                <div class="invalid-feedback">
                                    Por favor ingrese su contraseña.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-4">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>
                            <div class="text-center">
                                <p class="text-muted mb-2">
                                    <small>
                                        <!-- Updated icon and version info for Safe Pets -->
                                        <i class="fas fa-heart me-1"></i>
                                        Safe Pets v1.0.0 - 2025 &copy;
                                    </small>
                                </p>
                                <p class="text-muted mb-0">
                                    ¿No estás registrado? <a href="registro" class="text-primary">Crear cuenta</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vista/js/login.js"></script>
</body>
</html>
