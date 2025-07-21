@extends('Frontend.Home.home')

@section('content')

<div class="news-container">
        <!-- Floating Background Elements -->
        <div class="floating-elements">
            <div class="floating-shape"></div>
            <div class="floating-shape"></div>
            <div class="floating-shape"></div>
            <div class="floating-shape"></div>
        </div>
        
        <!-- Header Section -->
        <div class="header-section">
            <h1 class="header-title">Berita & Artikel</h1>
            <div class="header-divider"></div>
        </div>
        
        <!-- Article Container -->
        <div class="article-container">
            <article class="article-card">
                <div class="image-container">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=90"
                         alt="Kekerasan Seksual oleh Dosen"
                         class="article-image">
                    <div class="image-overlay"></div>
                </div>
                
                <div class="article-content">
                    <div class="article-meta">
                        <span class="article-badge">
                            📰 ARTIKEL
                        </span>
                        <span class="article-date">
                            <svg class="date-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Senin, 1 November 2025
                        </span>
                    </div>
                    
                    <h1 class="article-title">
                        Kekerasan Seksual dilakukan oleh Dosen ke Mahasiswa
                    </h1>
                    
                    <p class="article-excerpt">
                        Seorang mahasiswi dari salah satu universitas negeri di Yogyakarta melaporkan bahwa dirinya menjadi korban pelecehan seksual oleh seorang dosen pembimbing skripsi. Kasus ini pertama kali mencuat setelah korban, berinisial N, mengungkapkan pengalamannya melalui media sosial yang kemudian viral dan mendapat banyak dukungan dari warganet serta aktivis perempuan. Dalam unggahannya, N mengaku mendapatkan perlakuan tidak pantas selama proses bimbingan, termasuk ucapan bernada seksual dan ajakan bertemu di luar jam kampus dengan alasan pribadi. Setelah unggahan tersebut ramai diperbincangkan, pihak kampus melalui biro kemahasiswaan menyatakan akan segera menindaklanjuti laporan tersebut dengan membentuk tim investigasi khusus untuk menangani kasus ini secara serius dan profesional.
                    </p>
                </div>
            </article>
        </div>
    </div>

<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            background: #f8fafc;
        }

        .news-container {
            background: #ffffff;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        .news-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(34, 197, 94, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(16, 185, 129, 0.02) 0%, transparent 50%),
                radial-gradient(circle at 40% 60%, rgba(5, 150, 105, 0.04) 0%, transparent 50%);
            animation: backgroundFloat 20s ease-in-out infinite;
        }
        
        @keyframes backgroundFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(2deg); }
        }
        
        .header-section {
            position: relative;
            z-index: 2;
            padding: 5rem 2rem 3rem;
            text-align: center;
        }
        
        .header-title {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            animation: titleGlow 3s ease-in-out infinite;
            letter-spacing: -0.02em;
        }
        
        @keyframes titleGlow {
            0%, 100% { 
                text-shadow: 0 4px 20px rgba(0, 0, 0, 0.1), 0 0 30px rgba(34, 197, 94, 0.1);
            }
            50% { 
                text-shadow: 0 4px 25px rgba(0, 0, 0, 0.15), 0 0 40px rgba(34, 197, 94, 0.2);
            }
        }
        
        .header-divider {
            width: 150px;
            height: 6px;
            background: linear-gradient(90deg, #22c55e, #16a34a, #15803d, #22c55e);
            background-size: 400% 400%;
            animation: gradientFlow 4s ease infinite;
            margin: 0 auto;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        }
        
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .article-container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
        }
        
        .article-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 
                0 32px 64px rgba(0, 0, 0, 0.12),
                0 16px 32px rgba(0, 0, 0, 0.08),
                0 0 0 1px rgba(255, 255, 255, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            animation: cardFloat 8s ease-in-out infinite;
        }
        
        @keyframes cardFloat {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-15px) scale(1.005); }
        }
        
        .article-card:hover {
            transform: translateY(-25px) scale(1.02);
            box-shadow: 
                0 50px 100px rgba(0, 0, 0, 0.18),
                0 25px 50px rgba(0, 0, 0, 0.12),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.95);
        }
        
        .image-container {
            position: relative;
            overflow: hidden;
            height: 450px;
        }
        
        .article-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            filter: brightness(0.95) contrast(1.05);
        }
        
        .article-card:hover .article-image {
            transform: scale(1.08);
            filter: brightness(1.05) contrast(1.1);
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                135deg, 
                rgba(34, 197, 94, 0.3) 0%, 
                rgba(16, 185, 129, 0.2) 50%,
                rgba(5, 150, 105, 0.1) 100%
            );
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .article-card:hover .image-overlay {
            opacity: 1;
        }
        
        .article-content {
            padding: 3rem;
            position: relative;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .article-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 50%, #15803d 100%);
            color: white;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 
                0 8px 25px rgba(34, 197, 94, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
            animation: badgePulse 3s ease-in-out infinite;
            position: relative;
            overflow: hidden;
        }

        .article-badge::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: badgeShine 2s ease-in-out infinite;
        }

        @keyframes badgeShine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            50% { transform: translateX(100%) translateY(100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        @keyframes badgePulse {
            0%, 100% { transform: scale(1); box-shadow: 0 8px 25px rgba(34, 197, 94, 0.4); }
            50% { transform: scale(1.05); box-shadow: 0 12px 35px rgba(34, 197, 94, 0.6); }
        }
        
        .article-date {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #6b7280;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
            background: rgba(107, 114, 128, 0.1);
            border-radius: 25px;
        }
        
        .date-icon {
            width: 1.2rem;
            height: 1.2rem;
            color: #9ca3af;
        }
        
        .article-title {
            font-size: clamp(1.75rem, 3.5vw, 2.75rem);
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 2rem;
            line-height: 1.2;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #1f2937 0%, #4b5563 50%, #6b7280 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .article-title::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            border-radius: 50px;
            animation: titleUnderline 2s ease-in-out infinite;
        }

        @keyframes titleUnderline {
            0%, 100% { width: 80px; }
            50% { width: 120px; }
        }
        
        .article-excerpt {
            color: #4b5563;
            font-size: 1.15rem;
            line-height: 1.9;
            margin-bottom: 2.5rem;
            text-align: justify;
            position: relative;
            text-indent: 2rem;
        }
        
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.08);
            animation: float 8s ease-in-out infinite;
            backdrop-filter: blur(10px);
        }
        
        .floating-shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 15%;
            left: 8%;
            animation-delay: 0s;
            background: rgba(34, 197, 94, 0.1);
        }
        
        .floating-shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 50%;
            right: 8%;
            animation-delay: 2.5s;
            background: rgba(16, 185, 129, 0.08);
        }
        
        .floating-shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 25%;
            left: 15%;
            animation-delay: 5s;
            background: rgba(5, 150, 105, 0.12);
        }

        .floating-shape:nth-child(4) {
            width: 90px;
            height: 90px;
            top: 30%;
            right: 25%;
            animation-delay: 7s;
            background: rgba(21, 128, 61, 0.06);
        }
        
        @keyframes float {
            0%, 100% { 
                transform: translateY(0px) rotate(0deg) scale(1); 
                opacity: 0.6;
            }
            25% { 
                transform: translateY(-30px) rotate(90deg) scale(1.1); 
                opacity: 0.8;
            }
            50% { 
                transform: translateY(-60px) rotate(180deg) scale(1); 
                opacity: 1;
            }
            75% { 
                transform: translateY(-30px) rotate(270deg) scale(0.9); 
                opacity: 0.8;
            }
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .article-container {
                padding: 0 1.5rem 3rem;
            }
            
            .header-section {
                padding: 4rem 1.5rem 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .article-content {
                padding: 2rem 1.5rem;
            }
            
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .image-container {
                height: 300px;
            }

            .header-section {
                padding: 3rem 1rem 2rem;
            }

            .article-excerpt::first-letter {
                font-size: 2.5rem;
            }

            .floating-shape {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .article-content {
                padding: 1.5rem 1rem;
            }

            .header-divider {
                width: 100px;
            }

            .article-excerpt {
                text-indent: 1rem;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .news-container {
                background: #f8fafc;
            }

            .article-card {
                background: rgba(255, 255, 255, 0.98);
                border-color: rgba(0, 0, 0, 0.05);
            }

            .article-title {
                background: linear-gradient(135deg, #1f2937 0%, #374151 50%, #4b5563 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .article-excerpt {
                color: #4b5563;
            }

            .article-date {
                color: #6b7280;
                background: rgba(107, 114, 128, 0.1);
            }
        }
    </style>
@endsection