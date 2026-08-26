<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artigo - Romalha Pereira | Direito Imobiliário</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            background-color: #f5f1eb;
        }

        .article-page {
            background-color: #f5f1eb;
        }

        .article-back {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
            display: inline-block;
        }

        .article-header {
            background-color: white;
            padding: 40px 20px;
            margin-bottom: 40px;
        }

        .article-header-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .article-author {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .article-author-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--secondary-color);
        }

        .article-author-name {
            font-size: 14px;
            color: var(--secondary-color);
        }

        .article-title {
            font-size: 42px;
            font-weight: 300;
            letter-spacing: 1px;
            color: var(--primary-color);
            margin: 20px 0;
            line-height: 1.3;
        }

        .article-meta {
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: #999;
            margin-top: 15px;
        }

        .article-image {
            width: 100%;
            height: 500px;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            border-radius: 0;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 16px;
            object-fit: cover;
        }

        .article-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
            background-color: white;
        }

        .article-content-wrapper {
            padding: 60px 40px;
        }

        .article-tag {
            display: inline-block;
            background: #8b9d7f;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 25px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .article-content {
            font-size: 16px;
            line-height: 1.8;
            color: #555;
        }

        .article-content p {
            margin-bottom: 25px;
            text-align: justify;
        }

        .article-content h2 {
            font-size: 28px;
            margin: 45px 0 25px;
            color: var(--primary-color);
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        .article-content strong {
            color: var(--primary-color);
            font-weight: 600;
        }

        .article-cta-form {
            background-color: #f5f1eb;
            padding: 40px;
            border-radius: 0;
            margin: 60px 0;
            text-align: center;
        }

        .article-cta-form h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: var(--primary-color);
            font-weight: 400;
        }

        .article-cta-form p {
            margin-bottom: 25px;
            color: #999;
            font-size: 14px;
        }

        .cta-form-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .cta-form-group.full {
            grid-template-columns: 1fr;
        }

        .cta-form-group input {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            font-family: inherit;
        }

        .cta-form-group input:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .btn-cta {
            width: 100%;
            padding: 14px;
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 13px;
        }

        .btn-cta:hover {
            opacity: 0.9;
        }

        .article-footer {
            border-top: 1px solid #eee;
            padding-top: 40px;
            margin-top: 60px;
            text-align: center;
            padding-bottom: 40px;
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 28px;
            }

            .article-image {
                height: 300px;
            }

            .article-content-wrapper {
                padding: 30px 20px;
            }

            .cta-form-group {
                grid-template-columns: 1fr;
            }
        }
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

    <!-- Article Page -->
    <section class="article-page">
        <!-- Article Header with Title -->
        <div class="article-header">
            <div class="article-header-content">
                <a href="/blog" class="article-back">← Voltar ao Blog</a>

                <div class="article-author">
                    <div class="article-author-img"></div>
                    <div class="article-author-name">Romalha Pereira</div>
                </div>

                <h1 class="article-title" id="article-title">Carregando artigo...</h1>

                <div class="article-meta">
                    <span id="article-date"></span>
                    <span id="article-category"></span>
                </div>
            </div>
        </div>

        <!-- Article Image -->
        <div class="article-image" id="article-image"></div>

        <!-- Article Content -->
        <div class="article-container">
            <div class="article-content-wrapper">
                <span class="article-tag" id="article-tag"></span>

                <div class="article-content" id="article-content">
                    <!-- Conteúdo renderizado via JS -->
                </div>

                <!-- CTA Form -->
                <div class="article-cta-form">
                    <h3>Precisa de ajuda com seu imóvel?</h3>
                    <p>Entre em contato com a Romalha para uma consulta especializada</p>
                    <form style="max-width: 500px; margin: 0 auto;">
                        <div class="cta-form-group">
                            <input type="text" placeholder="Nome completo" required>
                            <input type="tel" placeholder="WhatsApp com DDD" required>
                        </div>
                        <button type="submit" class="btn-cta" onclick="window.location.href='https://wa.me/5524988648105'; return false;">Iniciar atendimento via WhatsApp</button>
                    </form>
                </div>

                <div class="article-footer">
                    <a href="/blog" class="article-back">← Voltar ao Blog</a>
                </div>
            </div>
        </div>
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
        // Pegar slug do artigo a partir da URL (/blog/:slug)
        const urlParams = new URLSearchParams(window.location.search);
        const slugFromQuery = urlParams.get('slug');
        const slugFromPath = window.location.pathname.replace(/^\/blog\//, '').replace(/\/$/, '');
        const articleSlug = slugFromQuery || slugFromPath;

        // Carregar dados
        fetch(`/api.phpblog/${articleSlug}`)
            .then(res => {
                if (!res.ok) throw new Error('Artigo não encontrado');
                return res.json();
            })
            .then(article => {
                // Preencher dados
                document.title = `${article.title} - Romalha Pereira`;
                document.getElementById('article-title').textContent = article.title;
                document.getElementById('article-date').textContent = new Date(article.date).toLocaleDateString('pt-BR');
                document.getElementById('article-category').textContent = article.category;
                document.getElementById('article-tag').textContent = article.category;
                if (article.image) {
                    document.getElementById('article-image').style.backgroundImage = `url('${article.image}')`;
                    document.getElementById('article-image').textContent = '';
                } else {
                    document.getElementById('article-image').textContent = article.category;
                }

                // Converter linhas em parágrafos
                const paragraphs = article.content.split('\n').map(p => p.trim()).filter(p => p);
                const contentHTML = paragraphs.map(p => `<p>${p}</p>`).join('');
                document.getElementById('article-content').innerHTML = contentHTML;
            })
            .catch(() => {
                document.getElementById('article-content').innerHTML = '<p>Artigo não encontrado</p>';
            });
    </script>
</body>
</html>
