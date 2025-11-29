<x-guest-layout>
    @section('title', 'تأیید رمز عبور')

    <div class="mb-4 text-muted">
        این یک بخش امن از برنامه است. لطفاً رمز عبور خود را تأیید کنید تا ادامه دهید.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="mb-3">
            <label for="password" class="form-label">رمز عبور</label>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   required 
                   autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-shield-check me-1"></i>
                تأیید
            </button>
        </div>
    </form>
</x-guest-layout>
