@include('assistant.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('assistant.layout.navbar')
    @include('assistant.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Add Service</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form method="post" action="{{route('assistant.add-service')}}">
            @csrf
            <div class="mb-3">
              <label for="service" class="form-label">Services</label>
              <input type="text" class="form-control" id="service" name="service" placeholder="service" required>
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" class="form-control" id="price" name="price" placeholder="price" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </section>
    </div>

    @include('assistant.layout.footer')
  </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'Try Again'
            });
        @endif
    });
    </script>

</body>
</html>
