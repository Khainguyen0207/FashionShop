@if (count($errors) > 0)
    <!-- Form Error List -->
    <div id="alert">
        <div class="alert alert-danger my-animation-alert">
            <span id="errors">
                {{ $errors->first() }}
            </span>
        </div>
    </div>
@endif

@if(session('error'))
<div id="alert">
    <div class="alert alert-danger my-animation-alert">
        {{ session('error') }}
    </div>
</div>
@endif

@session('success')
    <div id="alert">
        <div class="alert alert-success my-animation-alert">
            <span id="success">
                {{ session('success') }}
            </span>
        </div>
    </div>
@endsession