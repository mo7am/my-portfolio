@extends('errors.layouts.master')

@section('title','500')

@section('content')
    <div class="misc-wrapper">
        <section class="text-center mt-5">
            <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_fclga8fl.json"
                background="transparent" speed="1" style="height: 300px;" loop autoplay>
            </lottie-player>
            <span class="badge badge-danger bg-danger m-1">500 Error</span> We Are working to solve it.
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
