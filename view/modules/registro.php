<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Safe Pets</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="view/img/paw.png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
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

        .btn-secondary:hover:not(:disabled) {
            background: linear-gradient(to right, #6c6c6c, #8d8d8d);
            transform: translateY(-2px);
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

        .password-strength {
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white text-center py-4">
                        <h2 class="mb-0">
                            <i class="fas fa-paw me-2"></i>Registro - Safe Pets
                        </h2>
                        <p class="mb-0 mt-2 opacity-75">Únete a nuestra familia</p>
                    </div>
                    <div class="card-body">
                        <form method="post" id="formRegistro" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_usuario" class="form-label">
                                        <i class="fas fa-user me-2"></i>Nombre de Usuario
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nombre_usuario" 
                                           name="nombre_usuario" 
                                           placeholder="Usuario"
                                           required
                                           maxlength="50"
                                           pattern="[a-zA-Z0-9_]{3,50}"
                                           title="Solo letras, números y guiones bajos. Mínimo 3 caracteres.">
                                    <div class="invalid-feedback">
                                        Por favor ingrese un nombre de usuario válido (3-50 caracteres, solo letras, números y _).
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2"></i>Email
                                    </label>
                                    <input type="email" 
                                           class="form-control" 
                                           id="email" 
                                           name="email" 
                                           placeholder="correo@ejemplo.com"
                                           required
                                           maxlength="100">
                                    <div class="invalid-feedback">
                                        Por favor ingrese un email válido.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="contrasena" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Contraseña
                                    </label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="contrasena" 
                                           name="contrasena" 
                                           placeholder="Contraseña"
                                           required
                                           minlength="6">
                                    <div class="password-strength" id="password-strength"></div>
                                    <div class="invalid-feedback">
                                        Por favor ingrese una contraseña de al menos 6 caracteres.
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirmar_contrasena" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Confirmar Contraseña
                                    </label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="confirmar_contrasena" 
                                           name="confirmar_contrasena" 
                                           placeholder="Confirmar contraseña"
                                           required
                                           minlength="6">
                                    <div class="invalid-feedback">
                                        Por favor confirme su contraseña.
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Registrarse
                                </button>
                            </div>
                            <div class="d-grid gap-2 mb-4">
                                <a href="index.php?ruta=login" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i>Volver al Login
                                </a>
                            </div>
                            <div class="text-center">
                                <p class="text-muted mb-2">
                                    <small>
                                        <i class="fas fa-heart me-1"></i>
                                        Safe Pets v1.0.0 - 2025 &copy;
                                    </small>
                                </p>
                                <p class="text-muted mb-0">
                                    <small>Al registrarte, aceptas nuestros términos y condiciones.</small>
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
    
    <script>
        // Password strength indicator
        document.getElementById('contrasena').addEventListener('input', function() {
            const password = this.value;
            const strengthDiv = document.getElementById('password-strength');
            
            if (password.length === 0) {
                strengthDiv.textContent = '';
                return;
            }
            
            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;
            
            if (strength < 2) {
                strengthDiv.textContent = 'Contraseña débil';
                strengthDiv.className = 'password-strength strength-weak';
            } else if (strength < 4) {
                strengthDiv.textContent = 'Contraseña media';
                strengthDiv.className = 'password-strength strength-medium';
            } else {
                strengthDiv.textContent = 'Contraseña fuerte';
                strengthDiv.className = 'password-strength strength-strong';
            }
        });

        
        document.getElementById('confirmar_contrasena').addEventListener('input', function() {
            const password = document.getElementById('contrasena').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.setCustomValidity('Las contraseñas no coinciden');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
</body>
</html>
