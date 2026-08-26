<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Romalha Pereira | Direito Imobiliário</title>
    <meta name="description" content="Artigos e publicações sobre direito imobiliário, legalização de imóveis, compra e venda, garantias imobiliárias e muito mais.">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .blog-page { min-height: 100vh; }
        .blog-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }
        .blog-hero h1 {
            font-size: 48px;
            font-weight: 300;
            letter-spacing: 2px;
            margin: 20px 0;
        }
        .blog-hero .blog-tag {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }
        .blog-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .blog-card-image {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }
        .blog-card-content {
            padding: 30px;
        }
        .blog-card-tag {
            background: var(--light-bg);
            color: var(--secondary-color);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 12px;
        }
        .blog-card h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 12px 0;
            color: var(--primary-color);
            line-height: 1.4;
        }

        .blog-card-title-link {
            color: var(--primary-color);
            text-decoration: none;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .blog-card-title-link:hover {
            opacity: 0.8;
            text-decoration: underline;
        }
        .blog-card p {
            font-size: 14px;
            color: var(--secondary-color);
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .blog-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .blog-card-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
        }
        .blog-section { padding: 40px 20px; }
        .blog-loader { text-align: center; margin: 40px 0; color: var(--secondary-color); }
        .blog-end-message { text-align: center; margin: 40px 0; color: var(--secondary-color); }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <a href="/" class="logo-link">
                <div class="logo">
                    <div class="logo-text">
                        <h1>Romalha Pereira</h1>
                        <p class="subtitle">ADVOGACIA IMOBILIÁRIA</p>
                    </div>
                </div>
            </a>
            <a href="https://wa.me/5524988648105" class="whatsapp-btn" target="_blank">WhatsApp</a>
        </div>
    </header>

    <!-- Blog Hero -->
    <section class="blog-hero">
        <div class="container">
            <span class="blog-tag">Artigos & Conhecimento</span>
            <h1>Blog - <strong>Direito Imobiliário</strong></h1>
            <p style="font-size: 18px; margin-top: 20px; opacity: 0.95;">
                Informações, artigos e dicas sobre legalização de imóveis, direito imobiliário e consultoria especializada.
            </p>
        </div>
    </section>

    <!-- Blog Posts -->
    <section class="blog-section">
        <div class="container">
            <div id="blog-posts" class="blog-grid">
                <!-- Renderizado via JavaScript -->
            </div>
            <div id="blog-loader" class="blog-loader" style="display: none;">
                Carregando artigos...
            </div>
            <div id="end-message" class="blog-end-message" style="display: none;">
                ✓ Você visualizou todos os artigos
            </div>
        </div>
    </section>

    <!-- Back to Home -->
    <section class="blog-section" style="text-align: center; border-top: 1px solid #eee;">
        <a href="/" style="color: var(--primary-color); text-decoration: none; font-weight: 600;">
            ← Voltar para a Home
        </a>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
                <h3>Romalha Pereira</h3>
                <p>ADVOGACIA IMOBILIÁRIA</p>
            </div>
            <a href="https://wa.me/5524988648105" class="whatsapp-btn" target="_blank">WhatsApp</a>
        </div>
    </footer>

    <script>
        // Carregar dados do blog
        fetch('/api.phpblog?limit=100')
            .then(res => res.json())
            .then(data => {
                const postsContainer = document.getElementById('blog-posts');
                const posts = data.posts || [];

                posts.forEach(post => {
                    const card = document.createElement('div');
                    card.className = 'blog-card';
                    card.innerHTML = `
                        <div class="blog-card-image">${post.category}</div>
                        <div class="blog-card-content">
                            <span class="blog-card-tag">${post.category}</span>
                            <h3><a href="/blog/${post.slug}" class="blog-card-title-link">${post.title}</a></h3>
                            <p>${post.summary}</p>
                            <div class="blog-card-meta">
                                <span>${new Date(post.date).toLocaleDateString('pt-BR')}</span>
                                <a href="/blog/${post.slug}" class="blog-card-link">Ler mais →</a>
                            </div>
                        </div>
                    `;
                    postsContainer.appendChild(card);
                });

                if (posts.length === 0) {
                    document.getElementById('end-message').style.display = 'block';
                }
            });
    </script>
</body>
</html>
