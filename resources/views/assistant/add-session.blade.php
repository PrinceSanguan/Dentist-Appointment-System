@include('assistant.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('assistant.layout.navbar')
    @include('assistant.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Add Session</h1>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSessionModal">
            Add Session
        </button>

        <table class="table">
          <thead>
              <tr>
                  <th>User</th>
                  <th>Session Title</th>
                  <th>Schedule Date</th>
                  <th>Number of Members</th>
                  <th>Price</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($appointmentSessions as $session)
              <tr>
                  <td>{{ $session->user->full_name }}</td>
                  <td>{{ $session->session_title }}</td>
                  <td>{{ \Carbon\Carbon::parse($session->schedule_date)->format('F j, Y') }}</td>
                  <td>{{ $session->number_of_member }}</td>
                  <td>{{ $session->price }}</td>
              </tr>
              @endforeach
          </tbody>
      </table>

        <!-- Add Session Modal -->
          <div class="modal fade" id="addSessionModal" tabindex="-1" aria-labelledby="addSessionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSessionModalLabel">Add Session</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{ route('assistant.add-session') }}">
                      @csrf
                      <div class="modal-body">
                          <div class="mb-3">
                              <label for="dentist" class="form-label">Dentist</label>
                              <select class="form-control" id="user_id" name="user_id" required>
                                  <option selected disabled>Select Dentist</option>
                                  @foreach($dentists as $dentist)
                                      <option value="{{ $dentist->id }}">{{ $dentist->full_name }}</option>
                                  @endforeach
                              </select>
                          </div>
      
                          <div class="mb-3">
                              <label for="sessionTitle" class="form-label">Session Title</label>
                              <select class="form-control" id="sessionTitle" name="session_title" required>
                                  <option selected disabled>Select Session Title</option>
                                  @foreach($services as $service)
                                      <option value="{{ $service->service }}" data-price="{{ $service->price }}">{{ $service->service }}</option>
                                  @endforeach
                              </select>
                          </div>
      
                          <div class="mb-3">
                              <label for="price" class="form-label">Price</label>
                              <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" readonly>
                          </div>
      
                          <div class="mb-3">
                              <label for="schedule_date" class="form-label">Schedule Date</label>
                              <input type="date" class="form-control" id="schedule_date" name="schedule_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                          </div>
      
                          <div class="mb-3">
                              <label for="number_of_member" class="form-label">Number of Join</label>
                              <input type="number" min="1" max="19" class="form-control" id="number_of_member" name="number_of_member" required pattern="[0-9]+">
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </form>
                </div>
            </div>
          </div>
          <!-- Add Session Modal../ -->
        
        </div>
      </section>
    </div>

    @include('assistant.layout.footer')
    
  </div>

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sessionTitleSelect = document.getElementById('sessionTitle');
        const priceInput = document.getElementById('price');

        sessionTitleSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.dataset.price;
            priceInput.value = price;
        });
    });
</script>
</body>
</html>
