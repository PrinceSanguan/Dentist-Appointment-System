@include('assistant.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('assistant.layout.navbar')

    @include('assistant.layout.sidebar')

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
              <h3 class="card-title" style="font-size: 2em">Patient List</h3>
            </div>
            <div class="card-body">
              <table id="patientTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($patients as $patient)
                    <tr>
                      <td>{{ $patient->full_name }}</td>
                      <td>{{ $patient->email }}</td>
                      <td>{{ $patient->status }}</td>
                      <td>
                        <a href="#" class="btn btn-success view-patient" data-id="{{ $patient->id }}">View</a>
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

   <!-- Patient Details Modal -->
<div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="patientDetailsModalLabel">Patient Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body" id="patientDetailsContent">
              <!-- Patient details will be loaded here -->
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>
    <!-------------------------------------- Main content ---------------------------------------->

    @include('assistant.layout.footer')
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
      $("#patientTable").DataTable({
        responsive: true,
        autoWidth: false,
      });
    });
  </script>

<script>
    $(document).ready(function() {
      $('.view-patient').on('click', function(event) {
          event.preventDefault(); // Prevent default anchor behavior
          var patientId = $(this).data('id'); // Get the patient ID

          $.ajax({
              url: '{{ route('assistant.patient-view', '') }}/' + patientId, // Construct the URL
              type: 'GET',
              success: function(response) {
                  // Populate the modal with patient details and add a print button
                  $('#patientDetailsContent').html(response.html + `
                      <div class="text-right">
                          <button class="btn btn-primary" onclick="printAppointment()">Print</button>
                      </div>
                  `);
                  $('#patientDetailsModal').modal('show'); // Show the modal
              },
              error: function() {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'There was an error fetching patient details. Please try again.',
                      confirmButtonText: 'OK'
                  });
              }
          });
      });
  });

  // Print function
  function printAppointment() {
      var printContents = document.getElementById('patientDetailsContent').innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      location.reload();
  }
  </script>
  
</body>
</html>
