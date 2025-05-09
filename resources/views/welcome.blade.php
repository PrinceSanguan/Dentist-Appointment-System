<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R.L Tenorrio-Talicuran</title>

    <link rel="icon" type="image/png" href="images/favicon.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="css1/responsive-style.css">

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="100">


    <!-- Updated Header Section -->
    <header class="header_wrapper">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img decoding="async" src="{{ asset('images/logo.png') }}" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars navbar-toggler-icon"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav menu-navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#team">Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#gallery">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#testimonial">Testimonial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#blog">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#calendar">Calendar</a>
                        </li>
                        <li class="nav-item ms-lg-3">
                            <a class="nav-link fill-btn main-btn" href="{{ route('signin') }}">Sign in</a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link main-btn" href="{{ route('signup') }}">Sign up</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id="home" class="home">
        <div class="banner_wrapper wrapper">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 order-md-1 order-2">
                        <h3>Better Life Through</h3>
                        <h1>Better Dentistry</h1>
                        <p>Join us for a friendly and professional dental experience. Our team of experienced
                            professionals is dedicated to creating the beautiful smile you deserve in a comfortable
                            environment.</p>
                        <div class="mt-4 d-flex flex-wrap">
                            <a href="{{ route('signup') }}" class="main-btn fill-btn me-3 mb-2">Book Appointment</a>
                            <a href="#services" class="main-btn mb-2">View Services</a>
                        </div>
                    </div>
                    <div class="col-md-6 order-md-2 order-1 mb-md-0 mb-5">
                        <div class="top-right-sec">
                            <div class="animate-img">
                                <img decoding="async" class="aimg1"
                                    src="{{ asset('images/top-banner-img/woman-brush.png') }}">
                                <img decoding="async" class="aimg2"
                                    src="{{ asset('images/top-banner-img/doctor.png') }}">
                            </div>
                            <img decoding="async" class="img-fluid ms-xl-5"
                                src="{{ asset('images/top-banner-img/top-right-img-1.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card text-center">
                            <div class="icon-box">
                                <img decoding="async" src="{{ asset('images/top-banner-img/Appointment-icon.png') }}">
                            </div>
                            <div>
                                <h4>Easy Appointment</h4>
                                <p>Book your dental appointment online in just a few clicks, or call us for immediate
                                    assistance.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card text-center">
                            <div class="icon-box">
                                <img decoding="async" src="{{ asset('images/top-banner-img/Emergency-icon.png') }}">
                            </div>
                            <div>
                                <h4>Emergency Service</h4>
                                <p>Dental emergencies happen - we offer same-day emergency appointments for urgent care.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card text-center">
                            <div class="icon-box">
                                <img decoding="async" src="{{ asset('images/top-banner-img/7-Service-icon.png') }}">
                            </div>
                            <div>
                                <h4>24/7 Service</h4>
                                <p>Our dedicated team is available around the clock to address your dental concerns.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="calendar">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link href="{{ asset('plugins/fullcalendar/main.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/fullcalendar/main.min.js') }}"></script>

    <style>
        .fc-toolbar-title {
            color: rgb(0, 0, 0);
            /* Set the month text color to yellow */
            font-weight: bold;
            font-size: 3rem;
            /* Optional: Makes the month text bold for better readability */
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        info.el.style.backgroundColor = '#dc3545'; // red for no slots
                    } else if (remainingSlots > 1) {
                        info.el.style.backgroundColor = '#28a745'; // green for available slots
                    } else {
                        info.el.style.backgroundColor = '#ffc107'; // yellow for few slots
                    }

                    // Ensure text color is white for readability
                    info.el.style.color = 'white';
                    info.el.style.padding = '2px 4px';
                    info.el.style.borderRadius = '4px';
                },

            });

            calendar.render();
        });
    </script>


    <!-- Updated About Section -->
    <section id="about" class="about_wrapper wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-md-0 mb-5">
                    <div class="position-relative">
                        <img decoding="async" src="{{ asset('images/about/about-banner1.png') }}" class="img-fluid">
                        <img decoding="async" src="{{ asset('images/about/about-img2.png') }}"
                            class="about-animate">
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <h2>Welcome to Our Dental Family</h2>
                    <p class="mb-4">At R.L. Tenorrio-Talicuran Dental Clinic, we believe in creating healthy,
                        beautiful smiles in a comfortable and friendly environment. Our team of experienced
                        professionals is dedicated to providing top-quality dental care using the latest techniques and
                        equipment.</p>
                    <div class="mt-5 card">
                        <div class="about-clinic">
                            <h4>500+</h4>
                            <p>Happy Patients</p>
                        </div>
                        <div class="about-clinic">
                            <h4>88+</h4>
                            <p>Qualified Doctors</p>
                        </div>
                        <div class="about-clinic">
                            <h4>25+</h4>
                            <p>Years Experience</p>
                        </div>
                        <div class="about-clinic">
                            <h4>55+</h4>
                            <p>Dental Awards</p>
                        </div>
                        <span class="line-1"></span>
                        <span class="line-2"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="services" class="services_wrapper wrapper">
        <!-- Standard Price List Table -->
        <div class="card mt-4">
            <div class="card-header">
                <h1 class="card-title text-center" style="text-align: center; color:#000"><strong>Services</strong>
                </h1>
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
                            <td colspan="2" style="background-color: green; text-align: center"><strong>Oral
                                    Prophylaxis</strong></td>
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
                            <td colspan="2" style="background-color: green; text-align: center">
                                <strong>Restorations (per tooth surface)</strong>
                            </td>
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
                            <td colspan="2" style="background-color: green; text-align: center"><strong>Tooth
                                    Extraction</strong></td>
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
                            <td colspan="2" style="background-color: green; text-align: center"><strong>Root Canal
                                    Treatment</strong></td>
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
                            <td colspan="2" style="background-color: green; text-align: center">
                                <strong>Pedeatrics</strong>
                            </td>
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
                            <td colspan="2" style="background-color: green; text-align: center"><strong>Teeth
                                    Whitening</strong></td>
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
                            <td colspan="2" style="background-color: green; text-align: center">
                                <strong>Implants</strong>
                            </td>
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
                            <td colspan="2" style="background-color: green; text-align: center"><strong>Crown And
                                    Bridges</strong></td>
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
                            <td colspan="2" style="background-color: green; text-align: center">
                                <strong>Veneers</strong>
                            </td>
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
                            <td colspan="2" style="background-color: green; text-align: center"><strong>Partial
                                    Denture</strong></td>
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
                            <td colspan="2" style="background-color: yellow; text-align: center">
                                <strong>*subsequent increase in price depending on the number of missing teeth</strong>
                            </td>
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
                        </tr>
                        <tr>
                            <td>Rebase (per arch)</td>
                            <td>₱5000.00</td>
                        </tr>
                        <tr>
                            <td>Repair</td>
                            <td>min ₱1000.00</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="background-color: green; text-align: center"><strong>Complete
                                    Denture</strong></td>
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
                            <td colspan="2" style="background-color: green; text-align: center">
                                <strong>Orthodontics</strong>
                            </td>
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
                            <td colspan="2" style="background-color: yellow; text-align: center"><strong>*50% Down
                                    Payment for Ortho Treatment</strong></td>
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
                        <div class="signature"
                            style="margin-top: 20px; border-top: 1px solid #000; width: 200px; padding-top: 10px;">
                            <p class="text-center"
                                style="font-family: 'Cursive', sans-serif; font-size: 1.2em; font-style: italic;">
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
    </section>

    <section id="team" class="team_wrapper wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center mb-5">
                    <h3 class="text-black">Our Expert Dentists</h3>
                    <p class="mx-auto" style="max-width: 600px;">Meet our team of experienced dental professionals
                        dedicated to providing you with the highest quality care and beautiful smiles.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card rounded-3">
                        <div class="team-img">
                            <img decoding="async" src="{{ asset('images/team/pogi.webp') }}" class="img-fluid">
                        </div>
                        <div class="team-info pt-4 text-center">
                            <h5>Dr. John Smith</h5>
                            <p>Oral Surgeon</p>
                            <ul class="social-network">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card rounded-3">
                        <div class="team-img">
                            <img decoding="async" src={{ asset('images/team/pogi.webp') }} class="img-fluid">
                        </div>
                        <div class="team-info pt-4 text-center">
                            <h5>Dr. Maria Garcia</h5>
                            <p>Orthodontist</p>
                            <ul class="social-network">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card rounded-3">
                        <div class="team-img">
                            <img decoding="async" src={{ asset('images/team/pogi.webp') }} class="img-fluid">
                        </div>
                        <div class="team-info pt-4 text-center">
                            <h5>Dr. Robert Lee</h5>
                            <p>Cosmetic Dentist</p>
                            <ul class="social-network">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="gallery_wrapper wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center mb-5">
                    <h3>Our Gallery</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <img decoding="async" src="{{ asset('images/gallery/1.jpg') }}" class="w-100 h-100">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img decoding="async" src="{{ asset('images/gallery/2.jpg') }}" class="w-100 h-100">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img decoding="async" src="{{ asset('images/gallery/3.jpg') }}" class="w-100 h-100">
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <img decoding="async" src="{{ asset('images/gallery/5.jpg') }}" class="w-100 h-100">
                </div>
                <div class="col-md-8 col-sm-6 mb-4">
                    <img decoding="async" src="{{ asset('images/gallery/4.jpg') }}" class="w-100 h-100">
                </div>
            </div>
        </div>
    </section>


    <section id="testimonial" class="testimonial_wrapper wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center mb-4">
                    <h3 class="text-black">What Our Patients Say</h3>
                    <p class="mx-auto" style="max-width: 600px;">Real experiences from our satisfied patients who
                        trust us with their dental care.</p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-xl-3 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <img decoding="async" src="{{ asset('images/testimonial/testimonials.webp') }}"
                            class="img-fluid">
                        <h4 class="pt-4 mb-0">Sarah Johnson</h4>
                        <p>Regular Patient</p>
                    </div>
                </div>
                <div class="col-xl-9 col-md-8 col-sm-6 ps-md-4 pt-sm-0 pt-4">
                    <h4>Exceptional Dental Care</h4>
                    <p>"I can't say enough good things about this dental clinic. The entire team is incredible - they
                        truly took my individual case to heart. Everyone works together seamlessly to ensure my needs
                        were met, and I always leave feeling well-cared for. After years of dental anxiety, I finally
                        found a place where I feel comfortable. Highly recommended!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Updated Appointment CTA Section -->
    <section class="appointment_wrapper wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <h3>Ready for your smile makeover? Request your appointment today!</h3>
                    <p class="text-white mb-4">Our friendly team is ready to help you achieve the smile of your dreams.
                        Schedule your visit now!</p>
                    <a href="{{ route('signup') }}" class="main-btn fill-btn">Request Appointment</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Updated Blog Section -->
    <section id="blog" class="blog_wrapper wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center mb-5">
                    <h3 class="text-black">Latest From Our Blog</h3>
                    <p class="mx-auto" style="max-width: 600px;">Stay informed with the latest dental tips,
                        technologies, and health information from our expert team.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card p-0 border-0 rounded-0">
                        <img decoding="async" src="{{ asset('images/blog/1.jpg') }}">
                        <div class="blog-content">
                            <h5 class="text-white mb-2">Dental Insurance Benefits You Should Know</h5>
                            <h6 class="text-white">By Dr. Smith - May 9, 2025</h6>
                            <p class="mt-2 text-white">Understanding your dental insurance coverage can help you
                                maximize your benefits and minimize out-of-pocket expenses.</p>
                            <a href="#" class="main-btn mt-3">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card p-0 border-0 rounded-0">
                        <img decoding="async" src="{{ asset('images/blog/2.jpg') }}">
                        <div class="blog-content">
                            <h5 class="text-white mb-2">5 Tips for Better Oral Hygiene</h5>
                            <h6 class="text-white">By Dr. Garcia - May 3, 2025</h6>
                            <p class="mt-2 text-white">Simple daily habits that can dramatically improve your oral
                                health and help prevent tooth decay and gum disease.</p>
                            <a href="#" class="main-btn mt-3">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card p-0 border-0 rounded-0">
                        <img decoding="async" src="{{ asset('images/blog/3.jpg') }}">
                        <div class="blog-content">
                            <h5 class="text-white mb-2">Advanced Cosmetic Dentistry Options</h5>
                            <h6 class="text-white">By Dr. Lee - April 25, 2025</h6>
                            <p class="mt-2 text-white">Discover the latest advances in cosmetic dentistry that can give
                                you the perfect smile you've always wanted.</p>
                            <a href="#" class="main-btn mt-3">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="contact" class="footer_wrapper wrapper">
        <div class="container pb-3">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Clinic Location</h5>
                    <p class="ps-0">Visit our modern, comfortable dental clinic located in the heart of Taguig City,
                        Metro Manila.</p>
                    <div class="contact-info">
                        <ul class="list-unstyled p-0">
                            <li><a href="#"><i class="fa fa-map-marker-alt me-3"></i> 123 Main Street, Taguig
                                    City, Metro Manila</a></li>
                            <li><a href="tel:+6391234567890"><i class="fa fa-phone-alt me-3"></i> +63 912 345 6789</a>
                            </li>
                            <li><a href="mailto:info@rldentalclinic.com"><i class="fa fa-envelope me-3"></i>
                                    info@rldentalclinic.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Our Services</h5>
                    <ul class="link-widget p-0">
                        <li><a href="#services">General Dentistry</a></li>
                        <li><a href="#services">Cosmetic Dentistry</a></li>
                        <li><a href="#services">Orthodontics</a></li>
                        <li><a href="#services">Pediatric Dentistry</a></li>
                        <li><a href="#services">Oral Surgery</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="link-widget p-0">
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#team">Our Dentists</a></li>
                        <li><a href="#blog">Latest News</a></li>
                        <li><a href="#calendar">Appointment Calendar</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Newsletter</h5>
                    <div class="mb-4">
                        <p class="ps-0 mb-3">Subscribe to our newsletter for dental tips and special offers.</p>
                        <input type="email" class="form-control bg-transparent"
                            placeholder="Enter Your Email Here">
                        <button type="submit"
                            class="main-btn rounded-2 mt-3 border-white text-white">Subscribe</button>
                    </div>
                    <h5>Stay Connected</h5>
                    <ul class="social-network d-flex align-items-center p-0">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright-section">
            <p class="p-0">Copyright © 2025 <a href="#">R.L Tenorrio-Talicuran Dental Clinic</a> | All Rights
                Reserved</p>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script><!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

        // JavaScript to toggle navbar on scroll
        document.addEventListener("scroll", function() {
            const navbar = document.querySelector(".header_wrapper .navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("header-scrolled");
            } else {
                navbar.classList.remove("header-scrolled");
            }
        });
    </script>

</body>

</html>
