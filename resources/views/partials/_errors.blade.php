@if ($errors->any())

<div class="row">
    <div class="alert alert-danger col-md-4 col-md-offset-4" align="center">

        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>

</div>
@endif
