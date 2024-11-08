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
            <div class="col-sm-6">
              <h1 class="m-0">Book an Appointment</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="container mt-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <form action="{{route('patient.book-appointment')}}" method="post">
              @csrf
              
              <!-- Select Dentist -->
              <div class="form-group">
                <label for="dentist">Select Dentist:</label>
                <select id="dentist" name="dentist" class="form-control" required>
                  <option value="">-- Select Dentist --</option>
                  @foreach($dentists as $dentist)
                    <option value="{{ $dentist->id }}">{{ $dentist->full_name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Select Appointment Session (Service) -->
              <div class="form-group" id="service-container" style="display:none;">
                <label for="appointment_session">Select Service:</label>
                <select id="appointment_session" name="appointment_session" class="form-control" required>
                  <option value="">-- Select Service --</option>
                </select>
              </div>

              <!-- Select Time -->
              <div class="form-group" id="time-container" style="display:none;">
                <label for="appointment_time">Select Time:</label>
                <select id="appointment_time" name="appointment_time" class="form-control" required>
                  <option value="">-- Select Time --</option>
                </select>
              </div>

              <button type="submit" class="btn btn-primary btn-block mt-3">Book Appointment</button>
            </form>
          </div>
        </div>

        <!-- Appointment List (DataTable) -->
        <div class="card shadow-sm mt-4">
          <div class="card-body">
            <h4>Existing Appointments</h4>
            <table id="appointments_table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Doctor</th>
                  <th>Service</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($appointments as $appointment)
                <tr>
                  <td>{{ $appointment->user->full_name }}</td>
                  <td>{{ $appointment->appointmentSession->session_title }}</td>
                  <td>{{ $appointment->created_at->format('F j Y') }}</td>
                  <td>{{ $appointment->time }}</td>
                  <td>{{ $appointment->status }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    @include('patient.layout.footer')
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const dentistSelect = document.getElementById('dentist');
      const appointmentSessionSelect = document.getElementById('appointment_session');
      const appointmentTimeSelect = document.getElementById('appointment_time');
      const serviceContainer = document.getElementById('service-container');
      const timeContainer = document.getElementById('time-container');

      // Hide service and time initially
      serviceContainer.style.display = 'none';
      timeContainer.style.display = 'none';

      // Populate services based on selected dentist
      dentistSelect.addEventListener('change', function () {
        const dentistId = this.value;

        if (dentistId) {
          fetch(`/patient/${dentistId}/services`)
            .then(response => response.json())
            .then(data => {
              appointmentSessionSelect.innerHTML = '<option value="">-- Select Service --</option>';
              data.forEach(service => {
                appointmentSessionSelect.innerHTML += `<option value="${service.id}">${service.session_title}</option>`;
              });
              // Show the service dropdown once a dentist is selected
              serviceContainer.style.display = 'block';
            });
        } else {
          appointmentSessionSelect.innerHTML = '<option value="">-- Select Service --</option>';
          serviceContainer.style.display = 'none';  // Hide service if no dentist selected
          timeContainer.style.display = 'none';     // Also hide time container
        }
      });

      // Show time options after selecting a service and exclude booked times
      appointmentSessionSelect.addEventListener('change', function () {
        const selectedService = this.value;
        const dentistId = dentistSelect.value;

        if (selectedService) {
          fetch(`/patient/${dentistId}/${selectedService}/available-times`)
            .then(response => response.json())
            .then(data => {
              appointmentTimeSelect.innerHTML = '<option value="">-- Select Time --</option>';
              const timeSlots = data.available_times;  // available times fetched from backend
              const bookedTimes = data.booked_times;   // booked times from backend (assume it's sent)
              
              timeSlots.forEach(slot => {
                if (bookedTimes.includes(slot)) {
                  // Display booked times in red with a message
                  appointmentTimeSelect.innerHTML += `<option value="${slot}" style="color: red;" disabled>${slot} - This time is already booked!</option>`;
                } else {
                  // Display available times normally
                  appointmentTimeSelect.innerHTML += `<option value="${slot}">${slot}</option>`;
                }
              });
              timeContainer.style.display = 'block'; // Show the time container
            });
        } else {
          timeContainer.style.display = 'none';  // Hide if no service is selected
        }
      });

      // Initialize DataTable
      $(document).ready(function () {
        $('#appointments_table').DataTable();
      });
    });
</script>

  <style>
    .form-control {
      border-radius: 5px;
      padding: 5px;
      box-shadow: none;
      border: 1px solid #ccc;
    }

    .form-group label {
      font-weight: 600;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .card {
      border-radius: 10px;
    }

    .card-body {
      padding: 30px;
    }
  </style>

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
