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
      var eventsData = @json($events);

      // Create an object to track event dates in 'YYYY-MM-DD' format
      var eventDates = {};
      eventsData.forEach(event => {
        eventDates[new Date(event.date).toISOString().split('T')[0]] = true; // Normalize the date format
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
          start: event.date // Make sure event dates are in the correct format for FullCalendar
        })),

        dayCellDidMount: function(info) {
          var dateStr = info.date.toISOString().split('T')[0]; // Get the date as 'YYYY-MM-DD'
          
          if (eventDates[dateStr]) {
            info.el.style.backgroundColor = 'red'; // Mark the cell red if there's an event
          } else {
            info.el.style.backgroundColor = 'green'; // Mark the cell green if no events
          }
        },
      });

      calendar.render();
    });
  </script>
</body>
</html>
