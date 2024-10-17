@include('assistant.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('assistant.layout.navbar')

    @include('assistant.layout.sidebar')

    <!-------------------------------------- Main content ---------------------------------------->

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pending Appointments</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Patient Name</th>
                      <th>Doctor</th>
                      <th>Session Title</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($appointments as $appointment)
                    <tr>
                      <td>{{ $appointment->user->full_name }}</td>
                      <td>{{ $appointment->appointmentSession->user->full_name }}</td>
                      <td>{{ $appointment->appointmentSession->session_title }}</td>
                      <td>{{ date('F j, Y', strtotime($appointment->appointmentSession->schedule_date)) }}</td>
                      <td>{{ $appointment->time }}</td>
                      <td>{{ ucfirst($appointment->status) }}</td>
                      <td>
                        <button class="btn btn-info view-btn" data-id="{{ $appointment->id }}">View</button>
                        <button class="btn btn-success approve-btn" data-id="{{ $appointment->id }}">Approve</button>
                        <button class="btn btn-danger disapprove-btn" data-id="{{ $appointment->id }}">Disapprove</button>
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
    </div>

    <!-- Patient Details Modal -->
    <div class="modal fade" id="patientDetailsModal" tabindex="-1" aria-labelledby="patientDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center" id="patientDetailsModalLabel">Monash Dental<br>Appointment Completion Report</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="patientDetailsContent">
            <!-- Content will be populated dynamically -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="printButton">Print</button>
          </div>
        </div>
      </div>
    </div>

    @include('assistant.layout.footer')
  </div>

  <script>
    $(document).ready(function() {
      // Approve button logic
      $('.approve-btn').click(function() {
        const appointmentId = $(this).data('id');
        $.ajax({
          url: '/assistant/appointment-request/approve-appointment/' + appointmentId,
          method: 'POST',
          data: {_token: '{{ csrf_token() }}'},
          success: function(response) {
            location.reload();
          },
          error: function(error) {
            alert('Error approving appointment.');
          }
        });
      });

      // Disapprove button logic
      $('.disapprove-btn').click(function() {
        const appointmentId = $(this).data('id');
        $.ajax({
          url: '/assistant/appointment-request/disapprove-appointment/' + appointmentId,
          method: 'POST',
          data: {_token: '{{ csrf_token() }}'},
          success: function(response) {
            location.reload();
          },
          error: function(error) {
            alert('Error disapproving appointment.');
          }
        });
      });

      // View button logic
      $('.view-btn').click(function() {
        const appointmentId = $(this).data('id');
        $.ajax({
          url: '/assistant/appointment-request/view-appointment-details/' + appointmentId,
          method: 'GET',
          success: function(response) {
            const appointmentDate = new Date(response.appointment_session.schedule_date).toLocaleString('default', {
              month: 'long', day: 'numeric', year: 'numeric'
            });

            $('#patientDetailsContent').html(`
              <div class="row">
                  <div class="col-md-6">
                      <p><strong>Patient Number:</strong> ${response.user.id}</p>
                      <p><strong>Appointment Date:</strong> ${appointmentDate}</p>
                  </div>
                  <div class="col-md-6 text-right">
                      <p><strong>Patient Name:</strong> <strong>${response.user.full_name}</strong></p>
                      <p><strong>Time:</strong> <strong>${response.time}</strong></p>
                  </div>
              </div>
              <p><strong>Doctor:</strong> ${response.appointment_session.user.full_name}</p>
              <p><strong>Session Title:</strong> ${response.appointment_session.session_title}</p>
              <p><strong>Price:</strong> ₱${response.appointment_session.price}.00</p>
              <p><strong>Status:</strong> ${response.status}</p>
              <p><strong>Address:</strong> ${response.user.address}</p>
            `);
            $('#patientDetailsModal').modal('show');
          },
          error: function(error) {
            alert('Error fetching appointment details.');
          }
        });
      });

      // Print button logic
      $('#printButton').click(function() {
        const printContent = $('#patientDetailsContent').html();
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Appointment Details</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write('<h1 style="text-align:center;">Monash Dental</h1>');
        printWindow.document.write('<h2 style="text-align:center;">Appointment Completion Report</h2>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close(); // necessary for IE >= 10
        printWindow.print();
      });
    });
  </script>

</body>
</html>
