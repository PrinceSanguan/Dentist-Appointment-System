@include('admin.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('admin.layout.navbar')

    @include('admin.layout.sidebar')

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Appointment</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="far fa-calendar-alt"></i> FullCalendar
              </h3>
            </div>
            <div class="card-body">
              <div id="fullCalendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('admin.layout.footer')
  </div>

  <link href="{{ asset('plugins/fullcalendar/main.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('plugins/fullcalendar/main.min.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('fullCalendar');
      var eventsData = @json($events); // Events data passed from the controller

      // Create an object to track event dates but subtract one day from each
      var eventDates = {};
      eventsData.forEach(event => {
        // Parse event date and subtract one day
        var eventDate = new Date(event.date);
        eventDate.setDate(eventDate.getDate() - 1); // Subtract one day
        var formattedDate = eventDate.toISOString().split('T')[0]; // Convert back to 'YYYY-MM-DD' format
        eventDates[formattedDate] = true; // Store the new (one day earlier) date
      });

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
        },
        events: eventsData.map(event => ({
          title: event.title,
          start: event.date // Keep the original event date for display
        })),

        dayCellDidMount: function(info) {
          // Get date in 'YYYY-MM-DD' format from FullCalendar cell
          var dateStr = info.date.toISOString().split('T')[0];

          // For cells outside the current month, make them white
          if (info.isOtherMonth) {
            info.el.style.backgroundColor = 'white';
          } else if (eventDates[dateStr]) {
            // If the (one day earlier) date has an event, color it red
            info.el.style.backgroundColor = 'red';
          } else {
            // If no event on that day, color it green
            info.el.style.backgroundColor = 'green';
          }
        },
      });

      calendar.render();
    });
  </script>
</body>
</html>
