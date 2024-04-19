 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     {{-- Font --}}
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap"
         rel="stylesheet">
     {{-- Importo vite per raggruppare il file css e js --}}
     @vite(['resources/css/app.css', 'resources/js/app.js'])
     <!-- Vendor CSS Files -->
     <link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
     <link href="{{ url('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
     <link href="{{ url('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
     <link href="{{ url('assets/vendor/aos/aos.css" rel="stylesheet') }}">

     <!-- Template Main CSS Files -->
     <link href="{{ url('assets/css/variables.css') }}" rel="stylesheet">
     <link href="{{ url('assets/css/main.css') }}" rel="stylesheet">
     
     <title>Il Faro</title>

 </head>

 <body>
     <x-navbar />
     <main id="main" class="d-flex flex-column min-vh-100">
         {{ $slot }}
     </main>
     <x-footer/>    
     <script src="{{ url('assets/vendor/aos/aos.js') }}"></script>
     <script src="{{ url('assets/js/main.js') }}"></script>
 </body>

 </html>