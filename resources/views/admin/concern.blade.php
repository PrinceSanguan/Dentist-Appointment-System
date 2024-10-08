@include('admin.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('admin.layout.navbar')

    @include('admin.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Patient Concerns</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Concerns Table -->
          <div class="card">
            <div class="card-header bg-primary text-white">
              <h3 class="card-title">List of Concerns</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="concernsTable" class="table table-hover table-striped table-responsive-md">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Reply</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($concerns as $concern)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $concern->user->full_name }}</td>
                      <td>{{ $concern->title }}</td>
                      <td>{{ $concern->description }}</td>
                      <td>
                        <span class="badge badge-{{ $concern->status == 'open' ? 'warning' : 'success' }}">
                          {{ ucfirst($concern->status) }}
                        </span>
                      </td>
                
                      <td>
                        @if($concern->status == 'open')
                          <!-- Show input field for open concerns -->
                          <input type="text" class="form-control futuristic-input reply-input" id="reply-{{ $concern->id }}" value="{{ $concern->reply ?? '' }}" placeholder="Enter your reply...">
                        @else
                          <!-- Show the reply text for closed concerns -->
                          {{ $concern->reply ?? 'No reply yet' }}
                        @endif
                      </td>
                
                      <td>
                        @if($concern->status == 'open')
                          <!-- Show the save button only if the concern is open -->
                          <button class="btn btn-success btn-sm save-reply-btn" data-id="{{ $concern->id }}">
                            <i class="fas fa-save"></i> Save
                          </button>
                        @else
                          <!-- When closed, no actions allowed -->
                          <span class="text-muted">Closed</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    @include('admin.layout.footer')
  </div>

  <!-- Scripts -->
  <script>
    document.querySelectorAll('.save-reply-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        let concernId = this.getAttribute('data-id');
        let reply = document.getElementById(`reply-${concernId}`).value;
        // Implement AJAX call to save the reply
        console.log(`Saving reply for concern ${concernId}: ${reply}`);
      });
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.querySelectorAll('.save-reply-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      let concernId = this.getAttribute('data-id');
      let reply = document.getElementById(`reply-${concernId}`).value;

      // Send AJAX request to save the reply
      fetch("{{ route('concern.reply') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}',  // Include CSRF token for security
        },
        body: JSON.stringify({
          concern_id: concernId,
          reply: reply
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Show SweetAlert success message and refresh the page when "OK" is clicked
          Swal.fire({
            title: 'Success!',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'OK'
          }).then((result) => {
            if (result.isConfirmed) {
              // Refresh the page when the user clicks "OK"
              location.reload();
            }
          });
        } else {
          // Show SweetAlert error message
          Swal.fire({
            title: 'Error!',
            text: 'Failed to save the reply.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      })
      .catch(error => {
        console.error('Error:', error);
        // Show SweetAlert error message for any exceptions
        Swal.fire({
          title: 'Error!',
          text: 'An error occurred while saving the reply.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      });
    });
  });
</script>

  <style>
    /* Futuristic input styling */
    .futuristic-input {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
      box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
      transition: all 0.3s ease;
    }
    .futuristic-input:focus {
      background: rgba(0, 255, 255, 0.1);
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
      border-color: #00ffff;
      outline: none;
    }

    /* Responsive table */
    @media (max-width: 768px) {
      .table-responsive-md {
        font-size: 14px;
      }
      .table thead th {
        font-size: 14px;
      }
      .table tbody td {
        font-size: 14px;
      }
    }
  </style>
</body>
</html>
