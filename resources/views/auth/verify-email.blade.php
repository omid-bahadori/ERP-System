<x-guest-layout>
    @section('title', 'تأیید ایمیل')

    <div class="mb-4 text-muted">
        ممنون از ثبت نام شما! قبل از شروع، لطفاً آدرس ایمیل خود را با کلیک روی لینکی که برای شما ارسال کردیم تأیید کنید. اگر ایمیل را دریافت نکرده‌اید، می‌توانیم یک ایمیل دیگر برای شما ارسال کنیم.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            یک لینک تأیید جدید به آدرس ایمیلی که در زمان ثبت نام ارائه دادید ارسال شد.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-envelope me-1"></i>
                ارسال مجدد ایمیل تأیید
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary">
                <i class="bi bi-box-arrow-left me-1"></i>
                خروج
            </button>
        </form>
    </div>
</x-guest-layout>
