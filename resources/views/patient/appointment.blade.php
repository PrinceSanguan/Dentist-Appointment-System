@include('patient.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('patient.layout.navbar')

    @include('patient.layout.sidebar')

    <!-------------------------------------- Main content ---------------------------------------->

    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="font-size: 2em">Pick a Session</h3>
            </div>
            <div class="card-body">
              <form id="sessionForm" class="needs-validation" novalidate>
                <div class="form-group">
                  <label for="doctorSelect">Select Doctor</label>
                  <select class="form-control" id="doctorSelect" required>
                    <option value="">Choose a doctor...</option>
                    <option value="1">Dr. John Doe</option>
                    <option value="2">Dr. Jane Smith</option>
                    <option value="3">Dr. Mike Johnson</option>
                    <option value="4">Dr. Emily Brown</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select a doctor.
                  </div>
                </div>

                <div class="form-group" id="sessionGroup" style="display: none;">
                  <label for="sessionSelect">Select Session</label>
                  <select class="form-control" id="sessionSelect" required>
                    <option value="">Choose a session...</option>
                    <!-- Options will be populated dynamically -->
                  </select>
                  <div class="invalid-feedback">
                    Please select a session.
                  </div>
                </div>

                <div class="form-group" id="dateGroup" style="display: none;">
                  <label for="datePicker">Pick a Date</label>
                  <input type="date" class="form-control" id="datePicker" required>
                  <div class="invalid-feedback">
                    Please pick a date.
                  </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3" style="display: none;" id="submitBtn">Book Session</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-------------------------------------- Main content ---------------------------------------->

    @include('patient.layout.footer')
  </div>

  <!-- Include DataTables CSS and JS -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <!-- Include Bootstrap JS for Modal -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <!----Sweet Alert---->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('sessionForm');
      const doctorSelect = document.getElementById('doctorSelect');
      const sessionGroup = document.getElementById('sessionGroup');
      const sessionSelect = document.getElementById('sessionSelect');
      const dateGroup = document.getElementById('dateGroup');
      const datePicker = document.getElementById('datePicker');
      const submitBtn = document.getElementById('submitBtn');

      doctorSelect.addEventListener('change', function() {
        if (this.value) {
          sessionGroup.style.display = 'block';
          // Populate session options based on selected doctor
          // This is where you'd typically make an AJAX call to get the sessions
          sessionSelect.innerHTML = `
            <option value="">Choose a session...</option>
            <option value="1">Morning Session</option>
            <option value="2">Afternoon Session</option>
            <option value="3">Evening Session</option>
          `;
        } else {
          sessionGroup.style.display = 'none';
          dateGroup.style.display = 'none';
          submitBtn.style.display = 'none';
        }
      });

      sessionSelect.addEventListener('change', function() {
        if (this.value) {
          dateGroup.style.display = 'block';
          submitBtn.style.display = 'block';
        } else {
          dateGroup.style.display = 'none';
          submitBtn.style.display = 'none';
        }
      });

      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      });

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