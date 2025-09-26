@extends('resume.layouts.app')

@section('title','Projects')

@section('content')
<main class="container">
  <h1 data-aos="fade-right">Projects</h1>



  @foreach ($projects as $project)
  <section class="project" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
    <h2>{{ $project->title }}</h2>
    <ul class="meta">
      <li>Tech Stack: {{ implode(', ', $project->tags) }}</li>
      <li>{{ \Carbon\Carbon::parse($project->date)->format('Y') }}</li>
    </ul>
    <p>{{ $project->description }}</p>
    <div class="tags">
      @foreach ($project->tags as $tag)
      <span>{{ trim($tag) }}</span> 
      @endforeach
    </div>
    <ul class="meta">
      <li>Source Code: @if ($project->source_code) <a href="{{ $project->source_code }}" target="_blank">{{ $project->source_code }} </a> @else Not Available  @endif -> ({{ $project->other??'Public' }})</li>
    </ul>
    <ul class="meta">
      <li>Website Url: @if ($project->website_url) <a href="{{ $project->website_url }}" target="_blank">{{ $project->website_url }} </a> @else Not Available  @endif</li>
    </ul>
  </section>
  @endforeach
</main>
@endsection
