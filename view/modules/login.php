<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Safe Pets</title>
    
    <link rel="icon" type="image/png" href="view/img/paw.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, rgba(233, 222, 207, 0.95) 0%, rgba(214, 188, 165, 0.9) 100%);
            z-index: 0;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.97);
        }

        .card-header {
            background: linear-gradient(to right, #d6baa5, #bfa48b);
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 2px solid #e6e2dd;
            background-color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #c4a484;
            box-shadow: 0 0 0 0.2rem rgba(196, 164, 132, 0.25);
            background-color: #ffffff;
        }

        .btn-primary {
            background: linear-gradient(to right, #d6baa5, #c4a484);
            border: none;
            border-radius: 100px;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            color: #fff;
        }

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(to right, #c4a484, #d6baa5);
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(0,0,0,0.15), 0 3px 6px rgba(0,0,0,0.1);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .card-body {
            padding: 40px;
        }

        .form-label {
            font-weight: 600;
            color: #5c4b3b;
            margin-bottom: 10px;
        }

        .text-muted {
            font-size: 0.9rem;
            color: #7a6f67 !important;
        }

        .invalid-feedback {
            font-size: 0.85rem;
        }

        .card-header h2 {
            font-size: 2rem;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            color: #fff;
        }

        .opacity-75 {
            font-size: 1.1rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            color: #fff !important;
        }

        .text-primary {
            color: #d6baa5 !important;
            text-decoration: none;
            font-weight: 600;
        }

        .text-primary:hover {
            color: #c4a484 !important;
            text-decoration: underline;
        }

        .text-secondary {
            color: #8d7b6b !important;
            text-decoration: none;
        }

        .text-secondary:hover {
            color: #7a6f67 !important;
            text-decoration: underline;
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
                            <i class="fas fa-paw me-2"></i>Safe Pets
                        </h2>
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
                                       required
                                       maxlength="50">
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
                                       required
                                       minlength="6">
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
                                        <i class="fas fa-heart me-1"></i>
                                        Safe Pets v1.0.0 - 2025 &copy;
                                    </small>
                                </p>
                                <p class="text-muted mb-0">
                                    ¿No estás registrado? <a href="index.php?ruta=registro" class="text-primary">Crear cuenta</a>
                                </p>
                                <p class="text-muted mb-0 mt-2">

                                    <a href="index.php?ruta=preview" class="text-secondary">Ver página pública</a>

                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="view/js/login.js"></script>
</body>
</html>
