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

  <!-- Load FullCalendar CSS and JS -->
  <link href="{{ asset('plugins/fullcalendar/main.min.css') }}" rel="stylesheet" />
  <script src="{{ asset('plugins/fullcalendar/main.min.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('fullCalendar');
  
      // Get the events passed from the controller
      var eventsData = @json($formattedEvents); // Use formattedEvents
  
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth'
        },
        events: eventsData.map(event => ({
          title: event.title,  // Title with doctor's name from the controller
          start: event.date,   // Event date
        })),
        eventDidMount: function(info) {
          // If you need to apply any styles or changes to the rendered event
          info.el.innerHTML = info.event.title;
          info.el.style.color = 'white';  // Ensure HTML is rendered
        },
        dayCellDidMount: function(info) {
          // Get the date string for the current cell
          var dateStr = info.date.toISOString().split('T')[0];
  
          // Get the date string for the next day
          var previousDate = new Date(info.date);
          previousDate.setDate(previousDate.getDate() + 1);
          var previousDateStr = previousDate.toISOString().split('T')[0];
  
          // Check if there is an event on the current date
          var hasEventToday = eventsData.some(event => event.date === dateStr);
          
          // Check if there is an event on the previous day
          var hasEventYesterday = eventsData.some(event => event.date === previousDateStr);
  
          // Color the day green if there is an event tomorrow
          if (hasEventYesterday) {
            info.el.style.backgroundColor = 'green';
          }
        }
      });
  
      calendar.render();
    });
  </script>
  
</body>
</html>
