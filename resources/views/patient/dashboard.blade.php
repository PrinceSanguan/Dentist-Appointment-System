@include('patient.layout.header')

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    @include('patient.layout.navbar')

    @include('patient.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Patient Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
    
            <!-- Row for info boxes -->
            <div class="row">
                <!-- Appointment Info -->
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Next Appointment</h3>
                            <p>{{ $latestAppointmentDate->format('F j, Y') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a href="{{route('patient.appointment')}}" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
    
                <!-- Recent Medical History -->
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Medical History</h3>
                            <p>Last Visit: Sept 2024</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-medical"></i>
                        </div>
                        <a href="#" class="small-box-footer">View History <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
    
                <!-- Profile Info -->
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Your Profile</h3>
                            <p>Update your information</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <a href="{{route('patient.settings')}}" class="small-box-footer">Edit Profile <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- End of row for info boxes -->
    
            <!-- Welcome Message Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Welcome, {{$patientName}}!</h3>
                </div>
                <div class="card-body">
                    <p>
                        Welcome to <strong>R.L Dental Clinic</strong>! Here, we believe in the power of a confident smile. Our state-of-the-art 
                        facilities, combined with a warm and welcoming atmosphere, ensure that your visit is as pleasant as it is effective.
                        We're not just about fixing teeth; we're about creating lasting relationships and empowering you with a smile that lights up the room.
                    </p>
                    <p>
                        On this dashboard, you can:
                        <ul>
                            <li>View your next appointment details</li>
                            <li>Access your medical history</li>
                            <li>Update your personal information</li>
                            <li>Contact your dentist or clinic staff for any assistance</li>
                        </ul>
                    </p>
                </div>
            </div>
            <!-- End of Welcome Message Card -->
    
            <!-- Standard Price List Table -->
            <div class="card mt-4">
                <div class="card-header">
                    <h1 class="card-title text-center" style="text-align: center"><strong>Standard Price List</strong></h1>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dental Procedure</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row: Add more rows as needed -->
                            <tr>
                                <td style="background-color: green"><strong>Consultation</strong></td>
                                <td>₱500.00</td>
                            </tr>
                            <tr>
                              <td style="background-color: green"><strong>Periapical Radiograph</strong></td>
                              <td>₱500.00-₱750.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Oral Prophylaxis</strong></td>
                            </tr>
                            <tr>
                              <td>Light</td>
                              <td>₱1000.00-₱1200.00</td>
                            </tr>
                            <tr>
                              <td>Moderate</td>
                              <td>₱1300.00-₱1800.00</td>
                            </tr>
                            <tr>
                              <td>Heavy</td>
                              <td>₱1900.00-₱2500.00</td>
                            </tr>
                            <tr>
                              <td style="background-color: green"><strong>Flouride Varnish</strong></td>
                              <td>₱1200.00-₱1500.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Restorations (per tooth surface)</strong></td>
                            </tr>
                            <tr>
                              <td>Temporary Filling</td>
                              <td>₱500.00-₱700.00</td>
                            </tr>
                            <tr>
                              <td>Composite Filling</td>
                              <td>₱800.00-₱1000.00</td>
                            </tr>
                            <tr>
                              <td>Inlay/Onlay</td>
                              <td>₱5000.00-₱6000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Tooth Extraction</strong></td>
                            </tr>
                            <tr>
                              <td>Simple</td>
                              <td>₱1000.00-₱1500.00</td>
                            </tr>
                            <tr>
                              <td>Complicated</td>
                              <td>₱1600.00-₱2500.00</td>
                            </tr>
                            <tr>
                              <td>Odontectomy (simple)</td>
                              <td>₱7000.00-₱9000.00</td>
                            </tr>
                            <tr>
                              <td>Odontectomy (complicated)</td>
                              <td>₱10000.00-₱15000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Root Canal Treatment</strong></td>
                            </tr>
                            <tr>
                              <td>Monorooted</td>
                              <td>₱6000.00-₱8000.00</td>
                            </tr>
                            <tr>
                              <td>Multirooted (per canal)</td>
                              <td>₱5000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Pedeatrics</strong></td>
                            </tr>
                            <tr>
                              <td>Sealant</td>
                              <td> min ₱1000</td>
                            </tr>
                            <tr>
                              <td>Tooth Extraction</td>
                              <td>₱700.00-₱1000.00</td>
                            </tr>
                            <tr>
                              <td>Stainless Steel Crown</td>
                              <td>₱3500.00-₱4500.00</td>
                            </tr>
                            <tr>
                              <td>Space Maintainers (unilateral)</td>
                              <td>₱5000.00</td>
                            </tr>
                            <tr>
                              <td>Space Maintainers (bilateral)</td>
                              <td>₱10000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Teeth Whitening</strong></td>
                            </tr>
                            <tr>
                              <td>In-Office/Chairside</td>
                              <td>₱25000.00</td>
                            </tr>
                            <tr>
                              <td>Take Home</td>
                              <td>₱10000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Implants</strong></td>
                            </tr>
                            <tr>
                              <td>Bone Augmentation</td>
                              <td>₱25000.00</td>
                            </tr>
                            <tr>
                              <td>Dental Implant Body</td>
                              <td>₱45000.00</td>
                            </tr>
                            <tr>
                              <td>Dental Implant Abutment</td>
                              <td>₱45000.00</td>
                            </tr>
                            <tr>
                              <td>Dental Implant Crown</td>
                              <td>₱10000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Crown And Bridges</strong></td>
                            </tr>
                            <tr>
                              <td>Acrylic</td>
                              <td>₱3000.00-₱5000.00</td>
                            </tr>
                            <tr>
                              <td>PFTMC Ordinary Metal</td>
                              <td>min ₱7000.00</td>
                            </tr>
                            <tr>
                              <td>PFTMC Tilite Metal</td>
                              <td>min ₱8000.00</td>
                            </tr>
                            <tr>
                              <td>Zirconia Crown</td>
                              <td>₱25000.00-₱30000.00</td>
                            </tr>
                            <tr>
                              <td>Emax</td>
                              <td>₱20000.00-₱25000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Veneers</strong></td>
                            </tr>
                            <tr>
                              <td>Direct Composite Veneers</td>
                              <td>₱4000.00-₱5000.00</td>
                            </tr>
                            <tr>
                              <td>Indirect Composite Veneers</td>
                              <td>₱9000.00</td>
                            </tr>
                            <tr>
                              <td>Direct Porselain Veneers</td>
                              <td>₱17000.00-₱20000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Partial Denture</strong></td>
                            </tr>
                            <tr>
                              <td>One-Piece (unilateral)</td>
                              <td>min ₱10000.00</td>
                            </tr>
                            <tr>
                              <td>One-Piece (bilateral)</td>
                              <td>min ₱15000.00</td>
                            </tr>
                            <tr>
                              <td>Assembled Type(unilateral)</td>
                              <td>min ₱4000.00</td>
                            </tr>
                            <tr>
                              <td>Assembled Type (bilateral)</td>
                              <td>min ₱6000.00</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="background-color: yellow; text-align: center"><strong>*subsequent increase in price depending on the number of missing teeth</strong></td>
                            </tr>
                            <tr>
                              <td>Flexible Denture(unilateral)</td>
                              <td>₱8000.00-₱10000.00</td>
                            </tr>
                            <tr>
                              <td>Flexible Denture(bilateral)</td>
                              <td>₱15000.00-₱20000.00</td>
                            </tr>
                            <tr>
                              <td>Goldmesh (additional)</td>
                              <td>₱3000.00</td>
                            </tr>
                            <tr>
                              <td>Reline (per arch)</td>
                              <td>₱3000.00</td>
                            </tr> <tr>
                              <td>Rebase (per arch)</td>
                              <td>₱5000.00</td>
                            </tr> 
                            <tr>
                              <td>Repair</td>
                              <td>min ₱1000.00</td>
                            </tr> 
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Complete Denture</strong></td>
                            </tr>
                            <tr>
                              <td>New Ace/Naturatone</td>
                              <td>₱12000.00-₱15000.00</td>
                            </tr> 
                            <tr>
                              <td>New Ace PX</td>
                              <td>₱20000.00</td>
                            </tr>
                            <tr>
                              <td>Biotone</td>
                              <td>₱24000.00-₱25000.00</td>
                            </tr>
                            <tr>
                              <td>Bioform</td>
                              <td>₱24000.00-₱25000.00</td>
                            </tr>
                            <tr>
                              <td>Ivocap</td>
                              <td>₱50000.00</td>
                            </tr>
                            <tr>
                              <td>Thermosens</td>
                              <td>₱60000.00</td>
                            </tr> 
                            <tr>
                              <td colspan="2" style="background-color: green; text-align: center"><strong>Orthodontics</strong></td>
                            </tr>
                            <tr>
                              <td>Metal Brackets</td>
                              <td>₱50000.00-₱60000.00</td>
                            </tr>
                            <tr>
                              <td>Ceramic Brackets</td>
                              <td>₱80000.00</td>
                            </tr> 
                            <tr>
                              <td>Self-Ligating Brackets (metal)</td>
                              <td>₱100000.00</td>
                            </tr> 
                            <tr>
                              <td>Self-Ligating Brackets (ceramic)</td>
                              <td>₱120000.00</td>
                            </tr> 
                            <tr>
                              <td>Invisalign</td>
                              <td>₱250000.00-₱350000.00</td>
                            </tr>
                            <tr>
                              <td>Functional Appliance</td>
                              <td>₱20000.00</td>
                            </tr> 
                            <tr>
                              <td>Hawley's Retainers</td>
                              <td>₱10000.00</td>
                            </tr> 
                            <tr>
                              <td>Clear Aligners</td>
                              <td>₱14000.00</td>
                            </tr> 
                            <tr>
                              <td>Fixed Retainers</td>
                              <td>₱10000.00</td>
                            </tr> 
                            <tr>
                              <td>Tads</td>
                              <td>₱7000.00</td>
                            </tr> 
                            <tr>
                              <td>Recementation (brackets&bands)</td>
                              <td>₱500.00</td>
                            </tr> 
                            <tr>
                              <td>Replacement (brackets&bands)</td>
                              <td>₱700.00-₱1000.00</td>
                            </tr> 
                            <tr>
                              <td colspan="2" style="background-color: yellow; text-align: center"><strong>*50% Down Payment for Ortho Treatment</strong></td>
                            </tr>
                            <tr>
                              <td>TMJ (case to case basis)</td>
                              <td>min ₱45000.00</td>
                            </tr> 
                        </tbody>
                    </table>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <p><strong>Checked by:</strong> Council of Past Presidents (CPP)</p>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- Dummy Signature -->
                            <div class="signature" style="margin-top: 20px; border-top: 1px solid #000; width: 200px; padding-top: 10px;">
                                <p class="text-center" style="font-family: 'Cursive', sans-serif; font-size: 1.2em; font-style: italic;">
                                    Signature
                                </p>
                                <p class="text-center">Dr. Irene Ortiz Alonzo</p>
                                <p class="text-center">BPDC President</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Standard Price List Table -->
    
        </div><!-- /.container-fluid -->
    </section>

      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    @include('patient.layout.footer')
  </div>
</body>
</html>
