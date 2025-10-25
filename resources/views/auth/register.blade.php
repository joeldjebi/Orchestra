<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Orchestra Admin</title>
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

        .register-container {
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

        .register-left {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            color: white;
            text-align: center;
        }

        .register-logo {
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

        .register-logo i {
            font-size: 2.5rem;
            color: white;
        }

        .register-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .register-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .register-right {
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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

        .password-requirements {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .password-requirements h4 {
            font-size: 0.9rem;
            color: #374151;
            margin-bottom: 8px;
        }

        .password-requirements ul {
            list-style: none;
            font-size: 0.85rem;
            color: #64748b;
        }

        .password-requirements li {
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .password-requirements li i {
            font-size: 0.8rem;
        }

        .register-button {
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

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
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
            .register-container {
                grid-template-columns: 1fr;
                max-width: 400px;
            }

            .register-left {
                display: none;
            }

            .register-right {
                padding: 40px 30px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <a href="/" class="back-to-site">
        <i class="fas fa-arrow-left"></i>
        Retour au site
    </a>

    <div class="register-container">
        <div class="register-left">
            <div class="register-logo">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1 class="register-title">Rejoignez-nous</h1>
            <p class="register-subtitle">
                Créez votre compte administrateur pour accéder à l'interface de gestion d'Orchestra.
            </p>
        </div>

        <div class="register-right">
            <div class="form-header">
                <h2 class="form-title">Créer un compte</h2>
                <p class="form-subtitle">Remplissez le formulaire pour créer votre compte</p>
            </div>

            <form method="POST" action="/register">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="prenoms" class="form-label">Prénoms</label>
                        <input
                            type="text"
                            id="prenoms"
                            name="prenoms"
                            class="form-input @error('prenoms') error @enderror"
                            value="{{ old('prenoms') }}"
                            required
                            autocomplete="given-name"
                            autofocus
                        >
                        @error('prenoms')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nom" class="form-label">Nom</label>
                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            class="form-input @error('nom') error @enderror"
                            value="{{ old('nom') }}"
                            required
                            autocomplete="family-name"
                        >
                        @error('nom')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

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
                        autocomplete="new-password"
                    >
                    @error('password')
                        <div class="form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-input"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <div class="password-requirements">
                    <h4>Exigences du mot de passe :</h4>
                    <ul>
                        <li><i class="fas fa-check"></i> Au moins 6 caractères</li>
                        <li><i class="fas fa-check"></i> Mélange de lettres et chiffres recommandé</li>
                    </ul>
                </div>

                <button type="submit" class="register-button">
                    <i class="fas fa-user-plus"></i>
                    Créer le compte
                </button>
            </form>

            <div class="login-link">
                Déjà un compte ? <a href="/login">Se connecter</a>
            </div>
        </div>
    </div>
</body>
</html>
