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
      // Initialize FullCalendar
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: '/patient/appointments',  // URL to fetch events data
        displayEventTime: false,
  
        // Customize each event's appearance
        eventDidMount: function(info) {
          // Get the text content of the event title element
          const eventTitleEl = info.el.querySelector('.fc-event-title');
          const remainingSlots = parseInt(eventTitleEl.textContent.replace('Remaining Slots: ', ''));
  
          // Set the background color based on the remaining slots
          if (remainingSlots === 0) {
            eventTitleEl.style.backgroundColor = '#dc3545'; // Red for zero slots
          } else if (remainingSlots > 1) {
            eventTitleEl.style.backgroundColor = '#28a745'; // Green for more than one slot
          } else {
            eventTitleEl.style.backgroundColor = '#ffc107'; // Yellow for one slot
          }
  
          eventTitleEl.style.color = 'white'; // White text color for contrast
          eventTitleEl.style.padding = '2px 4px'; // Optional padding for better appearance
          eventTitleEl.style.borderRadius = '4px'; // Rounded corners for the text background
        },
  
        eventClick: function(info) {
          // Show additional info on click
          Swal.fire({
            title: 'Appointment',
            text: info.event.title,
            icon: 'info',
            confirmButtonText: 'OK'
          });
        }
      });
  
      calendar.render();
    });
  </script>

</body>
</html>
