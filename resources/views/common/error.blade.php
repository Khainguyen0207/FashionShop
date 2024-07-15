@if (count($errors) > 0)
    <!-- Form Error List -->
    <div class="alert alert-danger my-animation">
        <span id="errors">
            {{$errors->first()}}
        </span>
    </div>
@endif

@session('success')
<div class="alert alert-success my-animation">
    <span id="success">
        {{session('success')}}
    </span>
</div>
@endsession