@include('dentist.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('dentist.layout.navbar')

    @include('dentist.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Settings</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- Change Password Card -->
            <div class="col-md-4">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-key"></i> Change Password</h3>
                </div>
                <div class="card-body">
                  <p>Keep your account secure by updating your password regularly.</p>
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                </div>
              </div>
            </div>

            <!-- Edit User Profile Card -->
            <div class="col-md-4">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-user-edit"></i> Edit Profile</h3>
                </div>
                <div class="card-body">
                  <p>Update your personal information to keep your profile accurate and up-to-date.</p>
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                </div>
              </div>
            </div>

            <!-- Delete Account Permanently Card -->
            <div class="col-md-4">
              <div class="card card-danger">
                  <div class="card-header">
                      <h3 class="card-title"><i class="fas fa-trash-alt"></i> Delete Account Permanently</h3>
                  </div>
                  <div class="card-body">
                      <p>If you no longer wish to use this service, you can permanently delete your account.</p>
                      <button class="btn btn-danger" id="deleteAccountButton" data-toggle="modal" data-target="#confirmDeleteModal">Delete Account</button>
                  </div>
              </div>
            </div>

            <!-- Confirmation Modal -->
          <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Account Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete Account</button>
                    </div>
                </div>
            </div>
          </div>

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="changePasswordForm">
                  @csrf
                  <!-- Display Validation Errors -->
                  <div class="alert alert-danger d-none" id="errorList"></div>

                  <div class="form-group">
                      <label for="currentPassword">Current Password</label>
                      <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                  </div>
                  <div class="form-group">
                      <label for="newPassword">New Password</label>
                      <input type="password" class="form-control" id="newPassword" name="new_password" required>
                  </div>
                  <div class="form-group">
                      <label for="confirmPassword">Confirm New Password</label>
                      <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                  </div>
                  <button type="submit" class="btn btn-info">Update Password</button>
              </form>
          </div>
      </div>
  </div>
</div>
<!-- End Change Password Modal -->

      <!-- Edit Profile Modal -->
      <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('dentist.edit-profile')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group">
                  <label for="full_name">Full Name</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" value="{{$user->full_name}}" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                </div>
                <div class="form-group">
                  <label for="number">Number</label>
                  <input type="number" class="form-control" id="number" name="number" value="{{$user->number}}" required min="0">
                </div>
                <div class="form-group">
                  <label for="date">Date of Birth</label>
                  <input type="date" class="form-control" id="date" name="dob" required>
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}" required>
                </div>
                <button type="submit" class="btn btn-warning">Update Profile</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- End Edit Profile Modal -->

    </div>
    <!-- /.content-wrapper -->

    @include('dentist.layout.footer')
  </div>

  <!----Sweet Alert---->
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
  $(document).ready(function() {
      $('#changePasswordForm').on('submit', function(event) {
          event.preventDefault(); // Prevent the default form submission
          
          $.ajax({
              url: '{{ route('dentist.change-password') }}', // Your route for changing password
              type: 'POST',
              data: $(this).serialize(), // Serialize the form data
              success: function(response) {
                  // Handle success response
                  $('#errorList').addClass('d-none').empty();
                  // Use SweetAlert for success message
                  Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      text: response.message,
                      confirmButtonText: 'OK'
                  });
                  $('#changePasswordModal').modal('hide'); // Close the modal
              },
              error: function(xhr) {
                  // Handle validation errors
                  $('#errorList').removeClass('d-none').empty();
                  let errors = xhr.responseJSON.errors;
                  $.each(errors, function(key, value) {
                      $('#errorList').append('<li>' + value[0] + '</li>');
                  });
                  // Use SweetAlert for error message
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'Please fix the errors below.',
                      confirmButtonText: 'OK'
                  });
              }
          });
      });
  });
</script>

<script>
  $(document).ready(function() {
      $('#confirmDeleteButton').on('click', function() {
          $.ajax({
              url: '{{ route('dentist.delete-account') }}', // Your route for deleting the account
              type: 'POST',
              data: {
                  _token: '{{ csrf_token() }}', // Include CSRF token
              },
              success: function(response) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Account Deleted',
                      text: response.message,
                      confirmButtonText: 'OK'
                  }).then(() => {
                      window.location.href = '{{ route('welcome') }}'; // Redirect to welcome page
                  });
              },
              error: function(xhr) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops!',
                      text: 'There was an error deleting your account. Please try again.',
                      confirmButtonText: 'OK'
                  });
              }
          });
      });
  });
  </script> 

</body>
</html>
