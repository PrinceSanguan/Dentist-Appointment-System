@include('patient.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    @include('patient.layout.navbar')
    @include('patient.layout.sidebar')

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Appointment Details</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <p>Book for <strong>{{ \Carbon\Carbon::parse($appointment->schedule_date)->format('F j, Y') }}</strong></p>
            <p><strong>SELECT SLOT TYPE</strong></p>

            <div class="col-12">
              <div class="row">
                @php
                  $start = \Carbon\Carbon::createFromFormat('H:i', '08:00');
                @endphp

                @foreach(range(0, 15) as $i)
                  @php
                    $startTime = $start->copy()->addMinutes($i * 30);
                    $endTime = $startTime->copy()->addMinutes(30);
                    $formattedStartTime = $startTime->format('h:i A');
                    $formattedEndTime = $endTime->format('h:i A');
                    $slot = $formattedStartTime . ' - ' . $formattedEndTime;
                  @endphp
                  
                  <div class="col-3 mb-2">
                    <button class="btn btn-success btn-block" data-slot="{{ $slot }}" onclick="selectSlot('{{ $slot }}')">
                      {{ $slot }}
                    </button>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    @include('patient.layout.footer')
  </div>

  <!-- Modal -->
  <div class="modal fade" id="slotModal" tabindex="-1" role="dialog" aria-labelledby="slotModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="slotModalLabel">Selected Time Slot</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Fixed the hidden input -->
          <input type="hidden" id="appointmentSessionId" value="{{ $appointment->id }}">

          <div class="form-group">
            <label for="sessionTitle">Session Title:</label>
            <input type="text" class="form-control" id="sessionTitle" value="{{ $appointment->session_title }}" readonly>
          </div>

          <div class="form-group">
            <label for="selectedSlot">Selected Time Slot:</label>
            <input type="text" class="form-control" id="selectedSlot" readonly>
          </div>
          <div class="form-group">
            <label for="selectedDate">Appointment Date:</label>
            <input type="text" class="form-control" id="selectedDate" value="{{ \Carbon\Carbon::parse($appointment->schedule_date)->format('F j, Y') }}" readonly>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="confirmAppointment()">Confirm Appointment</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

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

    function selectSlot(slot) {
      // Set the selected slot in the modal
      document.getElementById('selectedSlot').value = slot;
      
      // Show the modal
      $('#slotModal').modal('show');
    }

    function confirmAppointment() {
    const selectedSlot = document.getElementById('selectedSlot').value;
    const selectedDate = document.getElementById('selectedDate').value;
    const appointmentSessionId = document.querySelector('input[value="{{ $appointment->id }}"]').value;

    Swal.fire({
        title: 'Confirm Appointment',
        text: `Are you sure you want to book an appointment for ${selectedDate} at ${selectedSlot}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, book it!',
        cancelButtonText: 'No, cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('patient.book-appointment') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // Include CSRF token
                    appointment_session_id: appointmentSessionId,
                    time: selectedSlot
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Booked!',
                            text: 'Your appointment has been booked successfully.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to the desired page after successful booking
                                window.location.href = "{{ route('patient.appointment') }}"; // Replace with the appropriate route
                            }
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            response.message || 'An error occurred while booking the appointment.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while booking the appointment. Please try again.',
                        'error'
                    );
                }
            });
        }
    });
  }
  </script>
</body>
</html>