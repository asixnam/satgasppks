<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(34, 197, 94, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(34, 197, 94, 0.1) 0%, transparent 50%);
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: #22c55e;
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .error-message {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #dc2626;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #374151;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .form-group input:focus {
            outline: none;
            border-color: #22c55e;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .login-button {
            width: 100%;
            padding: 0.875rem;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        }

        .login-button:hover {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(34, 197, 94, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .forgot-password {
            text-align: center;
            margin-top: 1.5rem;
        }

        .forgot-password a {
            color: #22c55e;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #16a34a;
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            padding: 0 1rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-button {
            flex: 1;
            padding: 0.75rem;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            color: #374151;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .social-button:hover {
            border-color: #22c55e;
            background-color: #f0fdf4;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
                margin: 1rem;
            }
            
            .login-header h2 {
                font-size: 1.75rem;
            }
        }

        .input-icon {
            position: relative;
        }

        .input-icon input {
            padding-left: 3rem;
        }

        .input-icon::before {
            content: '';
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-size: contain;
            background-repeat: no-repeat;
            z-index: 1;
        }

        .email-icon::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2322c55e' viewBox='0 0 24 24'%3E%3Cpath d='M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z'/%3E%3Cpolyline points='22,6 12,13 2,6'/%3E%3C/svg%3E");
        }

        .password-icon::before {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2322c55e' viewBox='0 0 24 24'%3E%3Crect x='3' y='11' width='18' height='11' rx='2' ry='2'/%3E%3Cpath d='M7 11V7a5 5 0 0 1 10 0v4'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Selamat Datang</h2>
            <p>Masuk ke akun Anda</p>
        </div>

        <div class="error-message" style="display: none;" id="error-message">
            Email atau password salah
        </div>

        <form id="loginForm" method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-icon email-icon">
                    <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon password-icon">
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>
            </div>

            <button type="submit" class="login-button">Masuk</button>
        </form>

        <div class="forgot-password">
            <a href="/forgot-password">Lupa password?</a>
        </div>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="social-login">
            <button class="social-button" type="button">
                <span>🔍</span> Google
            </button>
            <button class="social-button" type="button">
                <span>📘</span> Facebook
            </button>
        </div>
    </div>

    <script>
        // Simulasi error handling
        const form = document.getElementById('loginForm');
        const errorMessage = document.getElementById('error-message');
        
        form.addEventListener('submit', function(e) {
            // Hapus preventDefault untuk form Laravel yang sesungguhnya
            // e.preventDefault();
            
            // Simulasi validasi (hapus di implementasi sesungguhnya)
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                errorMessage.textContent = 'Email dan password harus diisi';
                errorMessage.style.display = 'block';
                e.preventDefault();
                return;
            }
            
            // Form akan submit secara normal ke Laravel
        });

        // Sembunyikan error message saat user mulai mengetik
        document.getElementById('email').addEventListener('input', function() {
            errorMessage.style.display = 'none';
        });
        
        document.getElementById('password').addEventListener('input', function() {
            errorMessage.style.display = 'none';
        });
    </script>
</body>
</html>
