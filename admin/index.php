<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Admin - Romalha Pereira</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f5f5f5; }

    /* ━━━━━━━━━━━━━ LOGIN ━━━━━━━━━━━━━ */
    .login-screen {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #2d2d2d 0%, #5a5a5a 100%);
    }
    .login-box {
      background: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
      width: 100%;
      max-width: 400px;
    }
    .login-box h1 { font-size: 28px; margin-bottom: 10px; color: #333; }
    .login-box p { color: #666; margin-bottom: 30px; font-size: 14px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
    .form-group input {
      width: 100%; padding: 12px; border: 2px solid #ddd;
      border-radius: 6px; font-size: 14px; transition: border-color .3s;
    }
    .form-group input:focus { outline: none; border-color: #7cbb00; }
    .btn {
      width: 100%; padding: 12px; background: #7cbb00;
      color: white; border: none; border-radius: 6px;
      font-weight: 600; cursor: pointer; transition: opacity .3s;
    }
    .btn:hover { opacity: 0.9; }
    .btn:disabled { opacity: 0.5; cursor: not-allowed; }
    .error-msg { color: #e74c3c; font-size: 14px; margin-top: 10px; display: none; }

    /* ━━━━━━━━━━━━━━ ADMIN PANEL ━━━━━━━━━━━━━━ */
    .admin-panel { display: none; }
    header {
      background: white; padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      display: flex; justify-content: space-between; align-items: center;
    }
    header h1 { font-size: 24px; color: #333; }
    .header-actions { display: flex; gap: 10px; }
    .btn-secondary {
      padding: 10px 20px; background: #e74c3c; color: white;
      border: none; border-radius: 6px; cursor: pointer; font-weight: 600;
    }
    .btn-secondary:hover { opacity: 0.9; }
    .container { max-width: 1200px; margin: 0 auto; padding: 30px 20px; }
    .tabs { display: flex; gap: 10px; margin-bottom: 30px; border-bottom: 2px solid #ddd; flex-wrap: wrap; }
    .tab-btn {
      padding: 12px 20px; background: none; border: none; cursor: pointer;
      font-weight: 600; color: #999; border-bottom: 3px solid transparent; transition: all .3s;
    }
    .tab-btn.active { color: #7cbb00; border-bottom-color: #7cbb00; }
    .tab-content { display: none; animation: fadeIn .3s; }
    .tab-content.active { display: block; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    .section {
      background: white; padding: 30px; border-radius: 12px;
      margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .section h2 { font-size: 22px; margin-bottom: 20px; color: #333; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .form-row.full { grid-template-columns: 1fr; }
    .field { display: flex; flex-direction: column; }
    .field label { margin-bottom: 8px; font-weight: 600; color: #333; font-size: 14px; }
    .field input, .field textarea, .field select {
      padding: 12px; border: 2px solid #ddd; border-radius: 6px;
      font-size: 14px; font-family: inherit; transition: border-color .3s;
    }
    .field input:focus, .field textarea:focus { outline: none; border-color: #7cbb00; }
    .field textarea { resize: vertical; min-height: 100px; }
    .image-upload {
      border: 2px dashed #ddd; border-radius: 6px; padding: 20px;
      text-align: center; cursor: pointer; transition: border-color .3s;
    }
    .image-upload:hover { border-color: #7cbb00; }
    .image-upload input { display: none; }
    .image-preview { margin-top: 10px; }
    .image-preview img { max-width: 100%; max-height: 200px; border-radius: 6px; }
    .card-editor {
      background: #f9f9f9; padding: 20px; border-radius: 8px;
      margin-bottom: 20px; border-left: 4px solid #7cbb00;
    }
    .card-editor h4 { font-size: 16px; margin-bottom: 15px; color: #333; }
    .action-buttons { display: flex; gap: 10px; margin-top: 30px; justify-content: flex-end; }
    .btn-primary {
      padding: 12px 30px; background: #7cbb00; color: white;
      border: none; border-radius: 6px; cursor: pointer; font-weight: 600; transition: opacity .3s;
    }
    .btn-primary:hover { opacity: 0.9; }
    .btn-primary:disabled { opacity: 0.5; cursor: not-allowed; }
    .success-msg { background: #27ae60; color: white; padding: 15px; border-radius: 6px; margin-bottom: 20px; display: none; }
    @media (max-width: 768px) {
      .form-row { grid-template-columns: 1fr; }
      header { flex-direction: column; gap: 15px; }
      .tabs { flex-wrap: wrap; }
    }
  </style>
</head>
<body>

<!-- ═══════════════ LOGIN -->
<div class="login-screen" id="loginScreen">
  <div class="login-box">
    <h1>🔐 Painel Admin</h1>
    <p>Romalha Pereira — Gerenciador de Conteúdo</p>
    <form id="loginForm">
      <div class="form-group">
        <label>Senha de Acesso</label>
        <input type="password" id="password" required placeholder="Digite a senha">
      </div>
      <button type="submit" class="btn">Acessar Painel</button>
      <div class="error-msg" id="errorMsg"></div>
    </form>
  </div>
</div>

<!-- ═══════════════ ADMIN PANEL -->
<div class="admin-panel" id="adminPanel">
  <header>
    <h1>📊 Painel de Controle</h1>
    <div class="header-actions">
      <button class="btn-secondary" onclick="logout()">Sair</button>
    </div>
  </header>

  <div class="container">
    <div class="success-msg" id="successMsg">✓ Alterações salvas com sucesso!</div>

    <div class="tabs">
      <button class="tab-btn active" onclick="switchTab('hero')">Hero</button>
      <button class="tab-btn" onclick="switchTab('sobre')">Sobre</button>
      <button class="tab-btn" onclick="switchTab('servicos')">Serviços</button>
      <button class="tab-btn" onclick="switchTab('contato')">Contato</button>
      <button class="tab-btn" onclick="switchTab('blog')">Blog</button>
    </div>

    <!-- ═══ HERO ═══ -->
    <div class="tab-content active" id="heroTab">
      <div class="section">
        <h2>Seção Hero (Topo do Site)</h2>
        <div class="form-row full">
          <div class="field"><label>Tagline</label><input type="text" id="hero-tagline" placeholder="Ex: Romalha Pereira • Direito Imobiliário"></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Título Principal</label><input type="text" id="hero-title" placeholder="Ex: Legalização de imóveis com"></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Título em Destaque (Bold)</label><input type="text" id="hero-titleBold" placeholder="Ex: expertise e segurança jurídica"></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Subtítulo</label><textarea id="hero-subtitle"></textarea></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Texto do Botão (CTA)</label><input type="text" id="hero-ctaText" placeholder="Ex: FALE COM A ROMALHA"></div>
        </div>
        <div class="form-row">
          <div class="field">
            <label>Foto Principal</label>
            <div class="image-upload" onclick="document.getElementById('hero-photoMain-input').click()">
              <p>Clique para selecionar imagem</p>
              <input type="file" id="hero-photoMain-input" accept="image/*" onchange="uploadImage(event, 'hero-photoMain')">
            </div>
            <div class="image-preview" id="hero-photoMain-preview"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══ SOBRE ═══ -->
    <div class="tab-content" id="sobreTab">
      <div class="section">
        <h2>Seção Sobre</h2>
        <div class="form-row full">
          <div class="field"><label>Label/Categoria</label><input type="text" id="sobre-label" placeholder="Ex: Sobre Romalha Pereira"></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Título</label><input type="text" id="sobre-title"></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Descrição Principal (intro)</label><textarea id="sobre-description"></textarea></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Filosofia / 2º parágrafo</label><textarea id="sobre-philosophy"></textarea></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Texto Detalhado / 3º parágrafo</label><textarea id="sobre-detailedText"></textarea></div>
        </div>
        <div class="form-row">
          <div class="field">
            <label>Foto da Romalha</label>
            <div class="image-upload" onclick="document.getElementById('sobre-photo1-input').click()">
              <p>Selecionar imagem</p>
              <input type="file" id="sobre-photo1-input" accept="image/*" onchange="uploadImage(event, 'sobre-photo1')">
            </div>
            <div class="image-preview" id="sobre-photo1-preview"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══ SERVIÇOS ═══ -->
    <div class="tab-content" id="servicosTab">
      <div class="section">
        <h2>Seção Serviços</h2>
        <div class="form-row full">
          <div class="field"><label>Título da Seção</label><input type="text" id="servicos-title"></div>
        </div>
        <div id="servicosCardsContainer"></div>
      </div>
    </div>

    <!-- ═══ CONTATO ═══ -->
    <div class="tab-content" id="contatoTab">
      <div class="section">
        <h2>Informações de Contato</h2>
        <div class="form-row">
          <div class="field"><label>E-mail</label><input type="text" id="contato-email"></div>
          <div class="field"><label>Telefone</label><input type="text" id="contato-telefone"></div>
        </div>
        <div class="form-row">
          <div class="field"><label>WhatsApp (só números, com DDI)</label><input type="text" id="contato-whatsapp" placeholder="5524988648105"></div>
          <div class="field"><label>OAB</label><input type="text" id="contato-oab"></div>
        </div>
        <div class="form-row full">
          <div class="field"><label>Localização / Endereço</label><textarea id="contato-localizacao"></textarea></div>
        </div>
        <div class="form-row">
          <div class="field"><label>Instagram (URL)</label><input type="text" id="contato-instagram"></div>
          <div class="field"><label>Site Legalizzare (URL)</label><input type="text" id="contato-site_legalizzare"></div>
        </div>
      </div>
    </div>

    <!-- ═══ BLOG ═══ -->
    <div class="tab-content" id="blogTab">
      <div class="section">
        <!-- Lista de posts -->
        <div id="blog-list-view">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
            <h2>Publicações do Blog</h2>
            <button class="btn-primary" onclick="editBlogPost(-1)" style="width: auto; padding: 10px 20px; font-size: 14px;">➕ Novo Post</button>
          </div>
          <div id="blogPostsList" style="display: flex; flex-direction: column; gap: 15px;"></div>
        </div>

        <!-- Editor de post -->
        <div id="blog-edit-view" style="display: none;">
          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
            <h2 id="blog-editor-title">Editar Post</h2>
            <button class="btn-secondary" onclick="showBlogList()" style="width: auto; padding: 10px 20px; font-size: 14px; background: #95a5a6;">Voltar para Lista</button>
          </div>

          <input type="hidden" id="blog-post-index" value="-1">

          <div class="form-row">
            <div class="field">
              <label>Título do Post</label>
              <input type="text" id="blog-post-title" oninput="generateSlug(this.value)" placeholder="Ex: A importância da legalização de imóveis">
            </div>
            <div class="field">
              <label>Slug (URL amigável)</label>
              <input type="text" id="blog-post-slug" placeholder="Ex: importancia-da-legalizacao">
            </div>
          </div>

          <div class="form-row">
            <div class="field"><label>Categoria</label><input type="text" id="blog-post-category" placeholder="Ex: Direito Imobiliário"></div>
            <div class="field"><label>Data de Publicação</label><input type="date" id="blog-post-date"></div>
            <div class="field">
              <label>Status</label>
              <select id="blog-post-status">
                <option value="published">📤 Publicado</option>
                <option value="draft">📝 Rascunho</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label>Imagem de Destaque</label>
              <div class="image-upload" onclick="document.getElementById('blog-post-img-input').click()">
                <p>Selecionar imagem</p>
                <input type="file" id="blog-post-img-input" accept="image/*" onchange="uploadBlogImage(event)">
              </div>
              <div class="image-preview" id="blog-post-img-preview"></div>
              <input type="hidden" id="blog-post-image-path">
            </div>
          </div>

          <div class="form-row full">
            <div class="field">
              <label>Resumo/Introdução (aparece na lista)</label>
              <textarea id="blog-post-summary" placeholder="Uma breve descrição sobre o assunto..." style="min-height: 80px;"></textarea>
            </div>
          </div>

          <div class="form-row full">
            <div class="field">
              <label>Conteúdo Completo (deixe uma linha em branco entre os parágrafos)</label>
              <textarea id="blog-post-content" placeholder="Escreva o texto completo do post aqui..." style="min-height: 250px;"></textarea>
            </div>
          </div>

          <div class="action-buttons" style="margin-top: 20px;">
            <button class="btn-primary" onclick="saveBlogPost()" style="width: auto; padding: 12px 30px;">Salvar Post</button>
          </div>
        </div>
      </div>
    </div>

    <!-- ═══ BOTÃO SALVAR TUDO ═══ -->
    <div class="action-buttons">
      <button class="btn-primary" onclick="saveAll()">💾 Salvar Todas as Alterações</button>
    </div>
  </div>
</div>

<script>
  let data = {};

  // ━━━━━━━━━━━━━━ LOGIN ━━━━━━━━━━━━━━
  document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const password = document.getElementById('password').value;
    const btn = e.target.querySelector('button');
    const errorMsg = document.getElementById('errorMsg');
    btn.disabled = true;
    errorMsg.style.display = 'none';
    try {
      const res = await fetch('/api.phplogin', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ password })
      });
      if (res.ok) {
        document.getElementById('loginScreen').style.display = 'none';
        document.getElementById('adminPanel').style.display = 'block';
        loadData();
      } else {
        errorMsg.textContent = 'Senha incorreta!';
        errorMsg.style.display = 'block';
      }
    } catch (err) {
      errorMsg.textContent = 'Erro ao conectar';
      errorMsg.style.display = 'block';
    }
    btn.disabled = false;
  });

  // ━━━━━━━━━━━━━━ LOAD DATA ━━━━━━━━━━━━━━
  async function loadData() {
    try {
      const res = await fetch('/api.phpadmin/data');
      data = await res.json();
      if (!data.hero) data.hero = {};
      if (!data.sobre) data.sobre = {};
      if (!data.servicos) data.servicos = { cards: [] };
      if (!data.contato) data.contato = {};
      if (!data.blog) data.blog = [];
      populateForm();
    } catch (err) {
      console.error('Erro ao carregar dados:', err);
    }
  }

  function populateForm() {
    // Hero
    document.getElementById('hero-tagline').value = data.hero.tagline || '';
    document.getElementById('hero-title').value = data.hero.title || '';
    document.getElementById('hero-titleBold').value = data.hero.titleBold || '';
    document.getElementById('hero-subtitle').value = data.hero.subtitle || '';
    document.getElementById('hero-ctaText').value = data.hero.ctaText || '';
    showImagePreview('hero-photoMain', data.hero.photoMain);

    // Sobre
    document.getElementById('sobre-label').value = data.sobre.label || '';
    document.getElementById('sobre-title').value = data.sobre.title || '';
    document.getElementById('sobre-description').value = data.sobre.description || '';
    document.getElementById('sobre-philosophy').value = data.sobre.philosophy || '';
    document.getElementById('sobre-detailedText').value = data.sobre.detailedText || '';
    showImagePreview('sobre-photo1', data.sobre.photo1);

    // Serviços
    document.getElementById('servicos-title').value = data.servicos.title || '';
    renderServiceCards();

    // Contato
    document.getElementById('contato-email').value = data.contato.email || '';
    document.getElementById('contato-telefone').value = data.contato.telefone || '';
    document.getElementById('contato-whatsapp').value = data.contato.whatsapp || '';
    document.getElementById('contato-oab').value = data.contato.oab || '';
    document.getElementById('contato-localizacao').value = data.contato.localizacao || '';
    document.getElementById('contato-instagram').value = data.contato.instagram || '';
    document.getElementById('contato-site_legalizzare').value = data.contato.site_legalizzare || '';

    // Blog
    renderBlogPostsList();
  }

  function renderServiceCards() {
    const container = document.getElementById('servicosCardsContainer');
    container.innerHTML = '';
    (data.servicos.cards || []).forEach((card, idx) => {
      const html = `
        <div class="card-editor">
          <h4>Serviço ${idx + 1}</h4>
          <div class="form-row">
            <div class="field">
              <label>Título</label>
              <input type="text" class="servicos-card-title" data-idx="${idx}" value="${(card.title || '').replace(/"/g, '&quot;')}">
            </div>
            <div class="field">
              <label>Texto do Botão</label>
              <input type="text" class="servicos-card-btnText" data-idx="${idx}" value="${(card.buttonText || '').replace(/"/g, '&quot;')}">
            </div>
          </div>
          <div class="form-row full">
            <div class="field">
              <label>Descrição curta</label>
              <textarea class="servicos-card-desc" data-idx="${idx}">${card.description || ''}</textarea>
            </div>
          </div>
          <div class="form-row full">
            <div class="field">
              <label>Texto completo da página de detalhe</label>
              <textarea class="servicos-card-detail" data-idx="${idx}" style="min-height:140px;">${card.detailContent || ''}</textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="field">
              <label>Imagem do serviço</label>
              <div class="image-upload" onclick="document.getElementById('servicos-img-${idx}').click()">
                <p>Selecionar imagem</p>
                <input type="file" id="servicos-img-${idx}" accept="image/*" onchange="uploadServiceImage(event, ${idx})">
              </div>
              <div class="image-preview" id="servicos-img-preview-${idx}"></div>
            </div>
          </div>
        </div>
      `;
      container.innerHTML += html;
      showImagePreview(`servicos-img-preview-${idx}`, card.image);
    });
  }

  // ━━━━━━━━━━━━━━ UPLOAD & PREVIEW ━━━━━━━━━━━━━━
  async function uploadImage(event, fieldId) {
    const file = event.target.files[0];
    if (!file) return;
    const formData = new FormData();
    formData.append('image', file);
    try {
      const res = await fetch('/api.phpadmin/upload', { method: 'POST', body: formData });
      const result = await res.json();
      if (result.success) {
        const parts = fieldId.split('-');
        const section = parts[0];
        const key = parts.slice(1).join('');
        if (data[section]) data[section][key] = result.path;
        showImagePreview(fieldId, result.path);
      }
    } catch (err) { alert('Erro ao fazer upload da imagem'); }
  }

  async function uploadServiceImage(event, idx) {
    const file = event.target.files[0];
    if (!file) return;
    const formData = new FormData();
    formData.append('image', file);
    try {
      const res = await fetch('/api.phpadmin/upload', { method: 'POST', body: formData });
      const result = await res.json();
      if (result.success) {
        data.servicos.cards[idx].image = result.path;
        showImagePreview(`servicos-img-preview-${idx}`, result.path);
      }
    } catch (err) { alert('Erro ao fazer upload da imagem'); }
  }

  function showImagePreview(fieldId, imagePath) {
    const id = fieldId.endsWith('-preview') ? fieldId : fieldId + '-preview';
    const preview = document.getElementById(id);
    if (!preview) return;
    if (imagePath) {
      const src = imagePath.startsWith('http') || imagePath.startsWith('/') ? imagePath : '/' + imagePath;
      preview.innerHTML = `<img src="${src}" alt="Preview">`;
    } else {
      preview.innerHTML = '';
    }
  }

  // ━━━━━━━━━━━━━━ TAB SWITCHING ━━━━━━━━━━━━━━
  function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById(tab + 'Tab').classList.add('active');
    event.target.classList.add('active');
    if (tab === 'blog') showBlogList();
  }

  // ━━━━━━━━━━━━━━ SAVE ALL ━━━━━━━━━━━━━━
  async function saveAll() {
    const btn = event.target;
    btn.disabled = true;

    data.hero.tagline = document.getElementById('hero-tagline').value;
    data.hero.title = document.getElementById('hero-title').value;
    data.hero.titleBold = document.getElementById('hero-titleBold').value;
    data.hero.subtitle = document.getElementById('hero-subtitle').value;
    data.hero.ctaText = document.getElementById('hero-ctaText').value;

    data.sobre.label = document.getElementById('sobre-label').value;
    data.sobre.title = document.getElementById('sobre-title').value;
    data.sobre.description = document.getElementById('sobre-description').value;
    data.sobre.philosophy = document.getElementById('sobre-philosophy').value;
    data.sobre.detailedText = document.getElementById('sobre-detailedText').value;

    data.servicos.title = document.getElementById('servicos-title').value;
    document.querySelectorAll('.servicos-card-title').forEach((i) => { data.servicos.cards[+i.dataset.idx].title = i.value; });
    document.querySelectorAll('.servicos-card-desc').forEach((i) => { data.servicos.cards[+i.dataset.idx].description = i.value; });
    document.querySelectorAll('.servicos-card-btnText').forEach((i) => { data.servicos.cards[+i.dataset.idx].buttonText = i.value; });
    document.querySelectorAll('.servicos-card-detail').forEach((i) => { data.servicos.cards[+i.dataset.idx].detailContent = i.value; });

    data.contato.email = document.getElementById('contato-email').value;
    data.contato.telefone = document.getElementById('contato-telefone').value;
    data.contato.whatsapp = document.getElementById('contato-whatsapp').value;
    data.contato.oab = document.getElementById('contato-oab').value;
    data.contato.localizacao = document.getElementById('contato-localizacao').value;
    data.contato.instagram = document.getElementById('contato-instagram').value;
    data.contato.site_legalizzare = document.getElementById('contato-site_legalizzare').value;

    try {
      const res = await fetch('/api.phpadmin/data', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
      });
      if (res.ok) {
        const m = document.getElementById('successMsg');
        m.textContent = '✓ Alterações salvas com sucesso!';
        m.style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
        setTimeout(() => m.style.display = 'none', 4000);
      }
    } catch (err) { alert('Erro ao salvar dados'); }
    btn.disabled = false;
  }

  // ━━━━━━━━━━━━━━ BLOG ━━━━━━━━━━━━━━
  function renderBlogPostsList() {
    const listContainer = document.getElementById('blogPostsList');
    listContainer.innerHTML = '';
    const posts = data.blog || [];
    if (posts.length === 0) {
      listContainer.innerHTML = '<p style="color:#777; font-style:italic;">Nenhuma publicação cadastrada.</p>';
      return;
    }
    posts.forEach((post, idx) => {
      const statusLabel = { 'published': '📤 Publicado', 'draft': '📝 Rascunho' };
      let dataStr = post.date ? new Date(post.date + 'T00:00:00').toLocaleDateString('pt-BR') : 'Sem data';
      const html = `
        <div class="card-editor" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; padding:15px 20px;">
          <div>
            <strong style="font-size:16px; color:#333;">${post.title}</strong>
            <div style="font-size:13px; color:#666; margin-top:4px;">
              <span>📅 ${dataStr}</span> | <span>${statusLabel[post.status] || post.status}</span> | <span>🏷️ ${post.category || ''}</span>
            </div>
          </div>
          <div style="display:flex; gap:8px;">
            <button class="btn-primary" onclick="editBlogPost(${idx})" style="width:auto; padding:8px 16px; font-size:13px;">✏️ Editar</button>
            <button class="btn-secondary" onclick="deleteBlogPost(${idx})" style="width:auto; padding:8px 16px; font-size:13px;">🗑️ Excluir</button>
          </div>
        </div>
      `;
      listContainer.innerHTML += html;
    });
  }

  function showBlogList() {
    document.getElementById('blog-list-view').style.display = 'block';
    document.getElementById('blog-edit-view').style.display = 'none';
  }

  function showBlogEditor(title) {
    document.getElementById('blog-editor-title').textContent = title;
    document.getElementById('blog-list-view').style.display = 'none';
    document.getElementById('blog-edit-view').style.display = 'block';
  }

  function generateSlug(text) {
    if (document.getElementById('blog-post-index').value === "-1") {
      const slug = (text || '').toString().toLowerCase().normalize('NFD')
        .replace(/[̀-ͯ]/g, '').replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-').replace(/^-+/, '').replace(/-+$/, '');
      document.getElementById('blog-post-slug').value = slug;
    }
  }

  function editBlogPost(idx) {
    document.getElementById('blog-post-index').value = idx;
    if (idx === -1) {
      showBlogEditor('➕ Criar Novo Post');
      document.getElementById('blog-post-title').value = '';
      document.getElementById('blog-post-slug').value = '';
      document.getElementById('blog-post-category').value = '';
      document.getElementById('blog-post-date').value = new Date().toISOString().substring(0, 10);
      document.getElementById('blog-post-status').value = 'published';
      document.getElementById('blog-post-summary').value = '';
      document.getElementById('blog-post-content').value = '';
      document.getElementById('blog-post-image-path').value = '';
      showImagePreview('blog-post-img', '');
    } else {
      showBlogEditor('✏️ Editar Post');
      const post = data.blog[idx];
      document.getElementById('blog-post-title').value = post.title || '';
      document.getElementById('blog-post-slug').value = post.slug || '';
      document.getElementById('blog-post-category').value = post.category || '';
      document.getElementById('blog-post-date').value = post.date || '';
      document.getElementById('blog-post-status').value = post.status || 'published';
      document.getElementById('blog-post-summary').value = post.summary || '';
      document.getElementById('blog-post-content').value = post.content || '';
      document.getElementById('blog-post-image-path').value = post.image || '';
      showImagePreview('blog-post-img', post.image);
    }
  }

  async function uploadBlogImage(event) {
    const file = event.target.files[0];
    if (!file) return;
    const formData = new FormData();
    formData.append('image', file);
    try {
      const res = await fetch('/api.phpadmin/upload', { method: 'POST', body: formData });
      const result = await res.json();
      if (result.success) {
        document.getElementById('blog-post-image-path').value = result.path;
        showImagePreview('blog-post-img', result.path);
      }
    } catch (err) { alert('Erro ao fazer upload da imagem'); }
  }

  function saveBlogPost() {
    const idx = parseInt(document.getElementById('blog-post-index').value);
    const title = document.getElementById('blog-post-title').value.trim();
    const slug = document.getElementById('blog-post-slug').value.trim();
    const category = document.getElementById('blog-post-category').value.trim();
    const date = document.getElementById('blog-post-date').value;
    const status = document.getElementById('blog-post-status').value;
    const summary = document.getElementById('blog-post-summary').value.trim();
    const content = document.getElementById('blog-post-content').value.trim();
    const image = document.getElementById('blog-post-image-path').value;

    if (!title || !slug) { alert('Preencha o Título e o Slug!'); return; }
    if (!date) { alert('Preencha a Data de Publicação!'); return; }

    if (!data.blog) data.blog = [];
    const postData = {
      id: idx === -1 ? (data.blog.length > 0 ? Math.max(...data.blog.map(p => p.id || 0)) + 1 : 1) : data.blog[idx].id,
      slug, title, category, date, status, image, summary, content
    };
    if (idx === -1) data.blog.unshift(postData);
    else data.blog[idx] = postData;

    renderBlogPostsList();
    showBlogList();
    const m = document.getElementById('successMsg');
    m.textContent = '✓ Post alterado! Clique em "Salvar Todas as Alterações" no rodapé para publicar no site.';
    m.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
    setTimeout(() => { m.style.display = 'none'; m.textContent = '✓ Alterações salvas com sucesso!'; }, 6000);
  }

  function deleteBlogPost(idx) {
    if (confirm(`Excluir o post "${data.blog[idx].title}"?`)) {
      data.blog.splice(idx, 1);
      renderBlogPostsList();
      const m = document.getElementById('successMsg');
      m.textContent = '✓ Post removido! Clique em "Salvar Todas as Alterações" no rodapé para aplicar.';
      m.style.display = 'block';
      window.scrollTo({ top: 0, behavior: 'smooth' });
      setTimeout(() => { m.style.display = 'none'; m.textContent = '✓ Alterações salvas com sucesso!'; }, 6000);
    }
  }

  // ━━━━━━━━━━━━━━ LOGOUT ━━━━━━━━━━━━━━
  async function logout() {
    if (confirm('Deseja sair do painel?')) {
      await fetch('/api.phplogout', { method: 'POST' });
      document.getElementById('loginScreen').style.display = 'flex';
      document.getElementById('adminPanel').style.display = 'none';
      document.getElementById('password').value = '';
    }
  }
</script>

</body>
</html>
