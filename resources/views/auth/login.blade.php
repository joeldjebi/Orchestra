<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Orchestra Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        .login-left {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            color: white;
            text-align: center;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        .login-logo i {
            font-size: 2.5rem;
            color: white;
        }

        .login-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .login-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .login-right {
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #64748b;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input.error {
            border-color: #ef4444;
        }

        .form-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox {
            width: 16px;
            height: 16px;
            accent-color: #3b82f6;
        }

        .checkbox-label {
            font-size: 0.9rem;
            color: #64748b;
        }

        .forgot-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            background: linear-gradient(135deg, #3b82f6 0%, #1e3a8a 100%);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .back-to-site {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .back-to-site:hover {
            transform: translateX(-5px);
        }

        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                max-width: 400px;
            }

            .login-left {
                display: none;
            }

            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <a href="/" class="back-to-site">
        <i class="fas fa-arrow-left"></i>
        Retour au site
    </a>

    <div class="login-container">
        <div class="login-left">
            <div class="login-logo">
                <i class="fas fa-cogs"></i>
            </div>
            <h1 class="login-title">Admin Panel</h1>
            <p class="login-subtitle">
                Accédez à l'interface d'administration d'Orchestra pour gérer votre contenu et vos utilisateurs.
            </p>
        </div>

        <div class="login-right">
            <div class="form-header">
                <h2 class="form-title">Connexion</h2>
                <p class="form-subtitle">Connectez-vous à votre compte administrateur</p>
            </div>

            <form method="POST" action="/login">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Adresse email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input @error('email') error @enderror"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    >
                    @error('email')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input @error('password') error @enderror"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-options">
                    <div class="checkbox-group">
                        <input type="checkbox" id="remember" name="remember" class="checkbox">
                        <label for="remember" class="checkbox-label">Se souvenir de moi</label>
                    </div>
                    <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                </div>

                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </button>
            </form>

            <div class="register-link">
                Pas encore de compte ? <a href="/register">Créer un compte</a>
            </div>
        </div>
    </div>
</body>
</html>
