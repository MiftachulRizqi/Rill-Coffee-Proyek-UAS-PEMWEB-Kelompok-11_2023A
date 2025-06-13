@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #F5F0E1;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
    }

    .doc-header {
        background-color: #5B3A29;
        color: #F5F0E1;
        padding: 2rem;
        text-align: center;
        border-bottom: 5px solid #FFD369;
    }

    .doc-header h1 {
        margin: 0;
        font-size: 2.5rem;
        font-weight: bold;
    }

    .doc-header p {
        margin-top: 0.5rem;
        font-size: 1.1rem;
        color: #e9d9c2;
    }

    .container {
        max-width: 1100px;
        margin: 2rem auto;
        padding: 1rem;
    }

    .section-title {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: #333;
        font-weight: 600;
        border-left: 6px solid #FFD369;
        padding-left: 0.75rem;
    }

    .api-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .api-card {
        background: #fff;
        border-radius: 10px;
        padding: 1.25rem;
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .api-card:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }

    .method-tag {
        display: inline-block;
        padding: 0.3rem 0.7rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        color: white;
        margin-right: 0.5rem;
    }

    .GET { background-color: #10b981; }
    .POST { background-color: #3b82f6; }
    .PUT { background-color: #facc15; color: #000; }
    .DELETE { background-color: #ef4444; }

    .endpoint-url {
        font-family: monospace;
        background-color: #f9fafb;
        padding: 0.5rem 0.6rem;
        border-radius: 6px;
        font-size: 0.9rem;
        color: #111827;
        display: inline-block;
        margin-top: 0.3rem;
    }

    .auth-label {
        background: #6b7280;
        color: white;
        font-size: 0.7rem;
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        margin-right: 0.5rem;
    }

    .modal-bg {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.6);
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .modal-content {
        background: #fff;
        width: 80%;
        max-width: 700px;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        animation: zoomIn 0.3s ease;
    }

    @keyframes zoomIn {
        from { transform: scale(0.7); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    .modal-close {
        float: right;
        font-size: 1.2rem;
        cursor: pointer;
    }

    @media (max-width: 600px) {
        .section-title { font-size: 1.4rem; }
        .doc-header h1 { font-size: 2rem; }
    }
</style>

<div class="doc-header">
    <h1>📘 RillCoffee API Documentation</h1>
    <p>Dokumentasi interaktif dan modern untuk integrasi API</p>
</div>

<div class="container">
    <h2 class="section-title">🔐 Authentication</h2>
    <div class="api-card">
        <p><strong>Basic Auth:</strong> <span class="endpoint-url">Authorization: Basic base64(username:password)</span></p>
        <p><strong>JWT:</strong> <span class="endpoint-url">Authorization: Bearer &lt;token&gt;</span></p>
    </div>

    <h2 class="section-title">📌 Endpoints</h2>
    <div class="api-grid">
        @php
        $endpoints = [
            ['Register', 'POST', '/api/register', '', 'Mendaftarkan akun baru pengguna menggunakan email dan password.'],
            ['Login', 'POST', '/api/login', '', 'Login dan mendapatkan token JWT untuk mengakses endpoint yang dilindungi.'],
            ['Get Menus', 'GET', '/api/menus-basic', 'Basic Auth', 'Mengambil daftar menu minuman yang tersedia di RillCoffee.'],
            ['Create Menu', 'POST', '/api/menus-basic', 'Basic Auth', 'Menambahkan menu minuman baru ke dalam database.'],
            ['Update Menu', 'PUT', '/api/menus-basic/{id}', 'Basic Auth', 'Memperbarui informasi menu berdasarkan ID menu.'],
            ['Delete Menu', 'DELETE', '/api/menus-basic/{id}', 'Basic Auth', 'Menghapus data menu berdasarkan ID dari database.'],
            ['Basic Auth Test', 'GET', '/api/basic-protected', 'Basic Auth', 'Mengakses endpoint untuk memastikan Basic Auth berhasil.'],
            ['Get User Profile', 'GET', '/api/user-profile', 'JWT', 'Mengambil profil user yang sedang login berdasarkan token JWT.'],
            ['Recommendations', 'GET', '/api/recommend', 'Coming Soon', 'Endpoint untuk mendapatkan rekomendasi menu berdasarkan preferensi user. (Segera Hadir)'],
        ];
        @endphp

        @foreach($endpoints as [$title, $method, $url, $auth, $desc])
        <div class="api-card" onclick="showModal(`{{ $title }}`, `{{ $method }}`, `{{ $url }}`, `{{ $auth }}`, `{{ $desc }}`)">
            <div style="margin-bottom: 0.4rem; font-weight: 600;">
                @if($auth)
                    <span class="auth-label">{{ $auth }}</span>
                @endif
                {{ $title }}
            </div>
            <div>
                <span class="method-tag {{ $method }}">{{ $method }}</span>
                <span class="endpoint-url">{{ $url }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal-bg" id="popupModal">
    <div class="modal-content">
        <span class="modal-close" onclick="hideModal()">&times;</span>
        <h3 id="modalTitle"></h3>
        <p><strong>Method:</strong> <span id="modalMethod"></span></p>
        <p><strong>Endpoint:</strong> <code id="modalURL"></code></p>
        <p><strong>Authorization:</strong> <span id="modalAuth"></span></p>
        <p id="modalDesc" style="margin-top: 1rem;"></p>
    </div>
</div>

<script>
    function showModal(title, method, url, auth, desc) {
        document.getElementById('modalTitle').innerText = title;
        document.getElementById('modalMethod').innerText = method;
        document.getElementById('modalURL').innerText = url;
        document.getElementById('modalAuth').innerText = auth || '-';
        document.getElementById('modalDesc').innerText = desc || 'Tidak ada penjelasan tersedia.';
        document.getElementById('popupModal').style.display = 'flex';
    }

    function hideModal() {
        document.getElementById('popupModal').style.display = 'none';
    }

    window.onclick = function(event) {
        let modal = document.getElementById('popupModal');
        if (event.target === modal) hideModal();
    }
</script>
@endsection