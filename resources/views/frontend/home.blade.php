@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <div class="hero" id="section1">
        <h1>Minum Rill Coffee<br>Seruput Rasa Nikmati Dunia</h1>
        <p>Selamat datang di Rill Coffee, tempat kami menyajikan kopi terbaik untuk mencerahkan hari Anda.</p>
        <a href="#section3" class="btn">Lihat Menu</a>
    </div>

    <!-- Section 2: Informasi Outlet -->
    <section class="section-2 responsive-container" id="section2">
        <div class="section-2-left">
            <img src="{{ asset('images/tempat[1].jpg') }}" alt="Logo Rill Coffee">
        </div>
        <div class="section-2-right">
            <h2 class="section-2-right__h2 black-clr">JADWAL <br> OPERASIONAL TOKO</h2>
            <p class="section-2-right__p black-clr" style="text-align: justify;">
                Selamat datang di Riil Coffee, tempat di mana aroma kopi terbaik bertemu dengan suasana yang nyaman.
                Kami buka setiap hari untuk menemani waktu santai dan produktif Anda: <br><br>
                🕙 Senin - Kamis & Sabtu - Minggu: <strong>10.00 - 23.00</strong> <br>
                🕐 Jumat: <strong>13.00 - 23.00</strong> <br><br>
                Kami tunggu kehadiran Anda di Riil Coffee!
            </p>
        </div>
    </section>

<!-- Section 3: Menu Kopi -->
    <section id="section3">
        <div class="menu-container">
            <h2>Menu Kopi Kami</h2>
            <form action="{{ route('menu.search') }}" method="GET" class="search-form">
                <input type="text" name="query" placeholder="Cari kopi..." value="{{ request('query') }}">
                <button type="submit">Cari</button>
            </form>
            <div class="menu-grid">
                @forelse ($menus as $menu)
                    <div class="menu-item">
                        @if ($menu->foto)
                            <img src="{{ asset($menu->foto) }}" alt="{{ $menu->nama_kopi }}">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Kopi">
                        @endif
                        <div class="menu-header">
                            <h3>{{ $menu->nama_kopi }}</h3>
                            <span class="price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                        </div>
                        <p class="menu-description">{{ $menu->deskripsi }}</p>
                        @auth
                            <a href="{{ route('order.create', $menu->id) }}" class="btn menu-btn">Pesan Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="btn menu-btn">Masuk untuk Pesan</a>
                        @endauth
                    </div>
                @empty
                    <p>Tidak ada menu yang ditemukan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section 4: Review -->
    <section id="review" class="review-section py-5">
        <div class="container">
            <h2 class="section-title">Berikan Review</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Review -->
            <form action="{{ route('reviews.store') }}" method="POST" class="review-form mb-5">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="form-label">Komentar</label>
                    <textarea name="message" class="form-control" id="message" rows="5" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label">Rating</label>
                    <div class="rating-stars d-flex justify-content-center gap-2 fs-4" id="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}">★</span>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark">Kirim Review</button>
                </div>
            </form>

            <!-- List Review -->
            <div class="review-list">
                <h3 class="text-center">Review Pelanggan</h3>
                @forelse ($reviews as $review)
                    <div class="review-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 text-center w-100">{{ $review->name }}</h5>
                            <div class="stars text-center w-100">
                                @for ($i = 0; $i < $review->rating; $i++) ★ @endfor
                                @for ($i = $review->rating; $i < 5; $i++) ☆ @endfor
                            </div>
                        </div>
                        <p class="mb-2 text-secondary fst-italic text-center">"{{ $review->message }}"</p>
                        <small class="text-muted text-center">{{ $review->created_at->format('d M Y') }}</small>
                    </div>
                @empty
                    <p class="text-center text-muted">Belum ada review.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section footer-map">
                <h3>Lokasi Kami</h3>
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15859.66670833815!2d106.84262
                        95!3d-6.4047357!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb4cfbfa4ae5%3A0xae19be6e87883505!2
                        sPT%20Nusa%20Multi%20Dimensi!5e0!3m2!1sid!2sid!4v1749270536004!5m2!
                        1sid!2sid" width="100%" height="200" style="border:0; border-radius: 10px;" 
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <a href="https://maps.google.com/?q=Graha+Nusa+Kalimulya" target="_blank" 
                class="btn" style="margin-top: 10px;">
                    📍 Lihat di Google Maps
                </a>
            </div>
            <div class="footer-section footer-contact">
                <h3>Kontak Kami</h3>
                <p>Email: info@rillcoffee.com</p>
                <p>Telepon: +62 812 3456 7890</p>
                <p>Alamat: Jl. Raya Kalimulya No.48 A, Kota Depok, Jawa Barat.</p>
            </div>
            <div class="footer-section footer-links">
                <h3>Halaman</h3>
                <ul>
                    <li><a href="{{ route('home') }}#section1" id="beranda-link">Beranda</a></li>
                    <li><a href="{{ route('home') }}#section3">Menu</a></li>
                    <li><a href="{{ url('/api-doc') }}">Dokumentasi</a></li>
                </ul>
            </div>
            <div class="footer-section footer-social">
                <h3>Ikuti Kami</h3>
                <a href="https://www.instagram.com/ilhamgty_/profilecard/?igsh=MXFnY2ZibTY0a2lrdA==" target="_blank">
                    <img src="{{ asset('images/instagram.png') }}" alt="Instagram">
                </a>
                <a href="https://www.tiktok.com/@ilhamgty_?_t=ZS-8x1cfgNVvuc&_r=1" target="_blank">
                    <img src="{{ asset('images/tiktok.png') }}" alt="TikTok">
                </a>
                <a href="hhttps://www.facebook.com/share/1LEyXpyqjR/" target="_blank">
                    <img src="{{ asset('images/facebook.png') }}" alt="Facebook">
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 Rill Coffee. Semua hak dilindungi.</p>
        </div>
    </footer>
@endsection

@push('scripts')
<script>
    // Scroll ke section1 saat klik link Beranda
    document.addEventListener('DOMContentLoaded', function () {
        const berandaLink = document.getElementById('beranda-link');
        if (berandaLink) {
            berandaLink.addEventListener('click', function (e) {
                e.preventDefault();
                const currentPath = window.location.pathname;
                const homePath = "{{ route('home', [], false) }}";
                if (currentPath === homePath) {
                    const section1 = document.getElementById('section1');
                    if (section1) {
                        section1.scrollIntoView({ behavior: 'smooth' });
                    }
                } else {
                    window.location.href = "{{ route('home') }}#section1";
                }
            });
        }
    });

    // Interaksi bintang rating
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#star-rating .star');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star, index) => {
            // Klik untuk memilih rating
            star.addEventListener('click', () => {
                const rating = parseInt(star.dataset.value);
                ratingInput.value = rating;
                stars.forEach((s, i) => {
                    s.classList.toggle('selected', i < rating);
                });
            });

            // Efek hover
            star.addEventListener('mouseenter', () => {
                stars.forEach((s, i) => {
                    s.classList.toggle('hovered', i <= index);
                });
            });

            // Hapus efek hover saat mouse keluar
            star.addEventListener('mouseleave', () => {
                stars.forEach(s => s.classList.remove('hovered'));
            });
        });
    });
</script>
@endpush