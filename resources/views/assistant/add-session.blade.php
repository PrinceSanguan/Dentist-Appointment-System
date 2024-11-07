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
          <form>
            <div class="mb-3">
              <label for="dentist" class="form-label">Dentist</label>
              <select class="form-control" id="dentist" required>
                <option selected disabled>Select Dentist</option>
                <option value="dentist1">Dentist 1</option>
                <option value="dentist2">Dentist 2</option>
                <!-- Add more options as needed -->
              </select>
            </div>
            
            <div class="mb-3">
              <label for="sessionTitle" class="form-label">Session Title</label>
              <select class="form-control" id="sessionTitle" required>
                <option selected disabled>Select Session Title</option>
                <option value="title1">Title 1</option>
                <option value="title2">Title 2</option>
                <!-- Add more options as needed -->
              </select>
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" class="form-control" id="price" placeholder="Enter Price" required>
            </div>

            <div class="mb-3">
              <label for="scheduleDate" class="form-label">Schedule Date</label>
              <input type="date" class="form-control" id="scheduleDate" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
            </div>

            <div class="mb-3">
              <label for="numberOfJoin" class="form-label">Number of Join</label>
              <input type="number" class="form-control" id="numberOfJoin" placeholder="Enter Number of Participants" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </section>
    </div>

    @include('assistant.layout.footer')
  </div>
</body>
</html>
