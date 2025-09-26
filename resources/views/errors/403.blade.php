@extends('errors.layouts.master')

@section('title','403')

@section('content')
    <div class="misc-wrapper">
        <section class="text-center mt-5">
            <lottie-player src="{{ asset('m3z76YVfJk.json') }}"
                background="transparent" speed="1" style="height: 300px;" loop autoplay>
            </lottie-player>
            <br>
            <h3 class="mt-3">You are not authorized to access this page.</h3>
        </section>
    </div>
    <div class="container-fluid misc-bg-wrapper">
        <img
        src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
        alt="page-misc-error"
        data-app-light-img="{{ asset('illustrations/bg-shape-image-light.png') }}"
        data-app-dark-img="{{ asset('illustrations/bg-shape-image-dark.png') }}" />
    </div>
@endsection

@section('scripts')
<script>
  anime({
    targets: '.row svg',
    translateY: 10,
    autoplay: true,
    loop: true,
    easing: 'easeInOutSine',
    direction: 'alternate'
  });

  anime({
    targets: '#zero',
    translateX: 10,
    autoplay: true,
    loop: true,
    easing: 'easeInOutSine',
    direction: 'alternate',
    scale: [{value: 1}, {value: 1.4}, {value: 1, delay: 250}],
    rotateY: {value: '+=180', delay: 200},
  });
</script>
@endsection
