@foreach ($activities as $activity)
  <li class="timeline-item timeline-item-transparent">
    <span class="timeline-point timeline-point-primary"></span>
    <div class="timeline-event">
      <div class="timeline-header">
        <h6 class="mb-0">{{ $activity->description }}</h6>
        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
      </div>
    </div>
  </li>
@endforeach
