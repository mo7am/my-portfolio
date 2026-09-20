@include('partials.content-locale-banner')
<div class="page-intro mb-4">
  <h4 class="mb-1">{{ $title }}</h4>
  @if(!empty($description))
    <p class="text-muted mb-0">{{ $description }}</p>
  @endif
</div>
