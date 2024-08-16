@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger my-animation-alert">
        <span id="errors">
            {{ $errors->first() }}
        </span>
    </div>
@endif

@session('success')
    <div class="alert alert-success my-animation-alert">
        <span id="success">
            {{ session('success') }}
        </span>
    </div>
@endsession
