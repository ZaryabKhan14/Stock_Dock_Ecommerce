@include('user.tags')
@include('user.header')

<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d111551.9926412813!2d-90.27317134641879!3d38.606612219170856!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sbd!4v1597926938024!5m2!1sen!2sbd"
        height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Information</span>
                        <h2>Contact Us</h2>
                        <p>As you might expect of a company that began as a high-end interiors contractor, we pay strict
                            attention.</p>
                    </div>
                    <ul>
                        <li>
                            <h4>America</h4>
                            <p>195 E Parker Square Dr, Parker, CO 801 <br />+43 982-314-0958</p>
                        </li>
                        <li>
                            <h4>France</h4>
                            <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="contact__form">
                    <form id="contact-form" action="{{ route('contact_us') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Name" name="name" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Message" name="message" required></textarea>
                                <button type="button" id="send-btn" class="site-btn">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

@include('user.footer')

<script>
    document.getElementById('send-btn').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent form submission
        
        // Check if the user is logged in
        @if(!Auth::check())
            Swal.fire({
                title: 'Not Logged In!',
                text: "You need to log in to send a message.",
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}"; // Redirect to login
                }
            });
        @else
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to send this message?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('contact-form').submit(); // Submit the form if confirmed
                }
            });
        @endif
    });

    @if(session('status'))
    Swal.fire({
        title: 'Success!',
        text: "{{ session('status') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
    @endif
</script>
