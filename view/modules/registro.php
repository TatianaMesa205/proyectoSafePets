<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Safe Pets</title>
    
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

        .btn-secondary {
            background: linear-gradient(to right, #8d8d8d, #6c6c6c);
            border: none;
            border-radius: 100px;
            padding: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            color: #fff;
        }

        .card-body { padding: 40px; }
        .form-label { font-weight: 600; color: #5c4b3b; margin-bottom: 10px; }
        .text-muted { font-size: 0.9rem; color: #7a6f67 !important; }
        .invalid-feedback { font-size: 0.85rem; }
        .card-header h2 { font-size: 2rem; font-weight: 700; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); color: #fff; }
        .opacity-75 { font-size: 1.1rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.1); color: #fff !important; }
        .password-strength { font-size: 0.8rem; margin-top: 5px; }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
        
        /* Estilo para los separadores */
        .section-divider {
            border-top: 2px dashed #d6baa5;
            margin: 30px 0;
            position: relative;
        }
        .section-title {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.97);
            padding: 0 15px;
            color: #8b5e3c;
            font-weight: bold;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8"> <div class="card">
                    <div class="card-header text-white text-center py-4">
                        <h2 class="mb-0">
                            <i class="fas fa-paw me-2"></i>Registro - Safe Pets
                        </h2>
                        <p class="mb-0 mt-2 opacity-75">Crea tu cuenta y perfil de adoptante</p>
                    </div>
                    <div class="card-body">
                        <form method="post" id="formRegistro" class="needs-validation" novalidate>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_usuario" class="form-label"><i class="fas fa-user me-2"></i>Usuario</label>
                                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Ej: usuario123" required pattern="[a-zA-Z0-9_]{3,50}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="correo@ejemplo.com" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contrasena" class="form-label"><i class="fas fa-lock me-2"></i>Contraseña</label>
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" required minlength="6">
                                    <div class="password-strength" id="password-strength"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirmar_contrasena" class="form-label"><i class="fas fa-lock me-2"></i>Confirmar</label>
                                    <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" placeholder="Repetir contraseña" required>
                                </div>
                            </div>

                            <div class="section-divider">
                                <span class="section-title">Datos Personales</span>
                            </div>

                            <div class="mb-3">
                                <label for="nombre_completo" class="form-label"><i class="fas fa-id-card me-2"></i>Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" placeholder="Tu nombre real completo" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cedula" class="form-label"><i class="fas fa-address-card me-2"></i>Cédula</label>
                                    <input type="number" class="form-control" id="cedula" name="cedula" placeholder="Número de documento" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label"><i class="fas fa-phone me-2"></i>Teléfono</label>
                                    <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Número de contacto" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="direccion" class="form-label"><i class="fas fa-map-marker-alt me-2"></i>Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ciudad y dirección de residencia" required>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-check-circle me-2"></i>Completar Registro
                                </button>
                            </div>
                            <div class="d-grid gap-2 mb-4">
                                <a href="index.php?ruta=login" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i>Volver al Login
                                </a>
                            </div>
                            <div class="text-center">
                                <a href="index.php" class="text-muted text-decoration-none"><small>Volver al Inicio sin registrarse</small></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="view/js/login.js"></script>
    
    <script>
        // Tu script original de validación de contraseña
        document.getElementById('contrasena').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('password-strength');
            
            if (password.length === 0) { strengthDiv.textContent = ''; return; }
            
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            if (strength < 2) {
                strengthDiv.textContent = 'Contraseña débil'; strengthDiv.className = 'password-strength strength-weak';
            } else if (strength < 4) {
                strengthDiv.textContent = 'Contraseña media'; strengthDiv.className = 'password-strength strength-medium';
            } else {
                strengthDiv.textContent = 'Contraseña fuerte'; strengthDiv.className = 'password-strength strength-strong';
            }
        });

        document.getElementById('confirmar_contrasena').addEventListener('input', function() {
            const password = document.getElementById('contrasena').value;
            if (this.value && password !== this.value) {
                this.setCustomValidity('Las contraseñas no coinciden');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>