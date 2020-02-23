@extends('back.base_layouts.app')

@section('content')
<script>
    jQuery(document).ready(function() {
        jQuery(".myselect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%",
            @if(app()->getLocale()=='ar')
            rtl:true,
            @endif

        });
    });

</script>


<ol class="breadcrumb bc-3" >
    <li>
    <a href="{{route('dashboard')}}"><i class="fa-home"></i>@lang('site.dashboard')</a>
    </li>
    <li class="active">

        <strong>@lang('site.create_category')</strong>
    </li>
</ol>

<h2>@lang('site.create_category')</h2><br>



<div class="row">
    @include('partials.messages')
    <form action="{{route('category.store')}}" method="post">
        @csrf()
          <div class="form-group">
              <label for="name" class="control-label mb-1">@lang('site.name')</label>
              <input id="name" name="name" type="text" class="form-control" placeholder="@lang('site.category_name')" >
          </div>


          <div>
              <button id="payment" type="submit" class="btn btn-lg btn-info btn-block" >
                  <i class="fa fa-lock fa-lg"></i>
                  @lang('site.create')
              </button>
          </div>
      </form>
</div>



@endsection


