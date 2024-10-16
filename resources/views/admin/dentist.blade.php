@include('admin.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('admin.layout.navbar')

    @include('admin.layout.sidebar')

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
              <h3 class="card-title" style="font-size: 2em">Dentist's List</h3>
              <!-- Add New Account Button -->
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addAccountModal">
                Add Dentist Account
              </button>
            </div>
            <div class="card-body">
              <table id="dentistTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dentists as $dentist)
                    <tr>
                      <td>{{ $dentist->full_name }}</td>
                      <td>{{ $dentist->email }}</td>
                      <td>{{ $dentist->status }}</td>
                      <td>
                        {{-- <a href=" {{ route('patients.view', $patient->id) }}" class="btn btn-success">View</a> --}}
                        <form action="{{ route('admin.dentist-delete', $dentist->id) }}" method="post" style="display:inline;">
                          @csrf
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Modal for Adding New Account -->
  <div class="modal fade" id="addAccountModal" tabindex="-1" role="dialog" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addAccountModalLabel">Add Dentist Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addDentistForm">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="fullName">Full Name</label>
              <input type="text" class="form-control" id="fullName" name="full_name" required>
              <span class="text-danger error-text full_name_error"></span>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <span class="text-danger error-text email_error"></span>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" required>
              <span class="text-danger error-text address_error"></span>
            </div>
            <div class="form-group">
              <label for="dob">Date of Birth</label>
              <input type="date" class="form-control" id="dob" name="dob" required>
              <span class="text-danger error-text dob_error"></span>
            </div>
            <div class="form-group">
              <label for="number">Mobile Number</label>
              <input type="number" class="form-control" id="number" name="number" required min="0">
              <span class="text-danger error-text number_error"></span>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
              <span class="text-danger error-text password_error"></span>
            </div>
            <div class="form-group">
              <label for="confirmPassword">Confirm Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
              <span class="text-danger error-text password_confirmation_error"></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Account</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
        $(document).ready(function() {
        // On form submit, prevent the default action and use AJAX
        $('#addDentistForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            
            let formData = new FormData(this);
            
            // Clear previous errors
            $('span.error-text').text('');

            $.ajax({
                url: "{{ route('admin.add-dentist') }}", // Laravel route to handle the request
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success === true) {
                        // If dentist is added successfully, show a success message and close the modal
                        $('#addAccountModal').modal('hide');
                        alert('Dentist account has been registered successfully!');
                        location.reload(); // Refresh the page to show updated data
                    }
                },
                error: function(response) {
                    // If there's an error, show the validation errors
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        $.each(errors, function(field, error) {
                            $('span.' + field + '_error').text(error[0]);
                        });
                    }
                }
            });
        });
    });
  </script>

    @include('admin.layout.footer')
  </div>

  <!-- Include DataTables CSS and JS -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script>
    $(function () {
      $("#dentistTable").DataTable({
        responsive: true,
        autoWidth: false,
      });
    });
  </script>

  <!----Sweet Alert---->
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
