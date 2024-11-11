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
              <h1 class="m-0">Book an Appointment</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-4">
        <div id="calendar"></div>
      </div>
    </div>

    @include('patient.layout.footer')
  </div>

  <!-- FullCalendar and dependencies -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: '/patient/appointments',
      displayEventTime: false,

      eventDidMount: function(info) {
        // Extract remaining slots from the event title (assuming title contains "Slots: X")
        const eventTitleEl = info.el.querySelector('.fc-event-title');
        const remainingSlots = parseInt(eventTitleEl.textContent.split(':')[1]);

        // Set background color based on remaining slots
        if (remainingSlots === 0) {
          info.el.style.backgroundColor = '#dc3545';  // red for no slots
        } else if (remainingSlots > 1) {
          info.el.style.backgroundColor = '#28a745';  // green for available slots
        } else {
          info.el.style.backgroundColor = '#ffc107';  // yellow for few slots
        }

        // Ensure text color is white for readability
        info.el.style.color = 'white';
        info.el.style.padding = '2px 4px';
        info.el.style.borderRadius = '4px';
      },

      eventClick: function(info) {
        const appointmentId = info.event.extendedProps.appointmentId;
        const remainingSlots = parseInt(info.event.title.split(':')[1]);

        if (remainingSlots > 0) {
          window.location.href = `/patient/appointment/${appointmentId}/details`;
        } else {
          Swal.fire({
            title: 'No Available Slots',
            text: 'Sorry, this session is fully booked.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      }
    });

    calendar.render();
  });
  </script>

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