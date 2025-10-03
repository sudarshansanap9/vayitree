<?php
    // Include the header you provided
    include 'header.php';
?>

<style>
    .vayi-brand-text {
        color: rgb(165, 42, 42);
    }
    .vayi-brand-bg {
        background-color: rgb(165, 42, 42);
    }
    .form-control:focus {
        border-color: rgba(165, 42, 42, 0.5);
        box-shadow: 0 0 0 0.25rem rgba(165, 42, 42, 0.25);
    }
    .btn-brand {
        background-color: rgb(165, 42, 42);
        color: white;
        border: 1px solid rgb(165, 42, 42);
    }
    .btn-brand:hover {
        background-color: #8B0000; /* A darker brown for hover */
        color: white;
        border-color: #8B0000;
    }
    #successMessage {
        display: none;
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: rgb(165, 42, 42);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        z-index: 1050;
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
</style>

<div class="container my-5">
    <main class="bg-white rounded-3 shadow-lg overflow-hidden">
        <div class="row g-0">
            
            <div class="col-lg-5 vayi-brand-bg text-white p-4 p-md-5">
                <h1 class="display-5 fw-bold mb-4">Get in Touch</h1>
                <p class="text-light mb-5">
                    We'd love to hear from you. Whether you have a question about our products, practices, or partnerships, our team is ready to help.
                </p>

                <div class="d-flex flex-column gap-4">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-phone fa-fw fs-5 me-3"></i>
                        <a href="tel:+919591771404" class="text-white text-decoration-none">+91 9767734369</a>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-envelope fa-fw fs-5 me-3"></i>
                        <a href="mailto:houseofvayitree@gmail.com" class="text-white text-decoration-none">houseofvayitree@gmail.com</a>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="fa fa-map-marker-alt fa-fw fs-5 me-3 mt-1"></i>
                        <span>Vayitree 
                              Shop no.3, Marshal Arcade,
                              Opp.Racca Garden, Racca Colony, Saharanpur Road, Nashik-422002
                               <br> </span>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-top border-white-50">
                    <p class="text-light mb-3">Follow us:</p>
                    <div class="d-flex gap-3">
                        <a href="https://www.instagram.com/house_of_vayitree/" target="_blank" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.facebook.com/profile.php?id=100063918199444" target="_blank" class="text-white fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="https://wa.me/919767734369" target="_blank" class="text-white fs-5"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 p-4 p-md-5">
                <h2 class="fw-bold vayi-brand-text mb-4">Send us a message</h2>
                <form id="contactForm" action="https://formspree.io/f/xzzjgyol" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" id="firstName" name="firstName" required class="form-control" placeholder="John">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" id="lastName" name="lastName" required class="form-control" placeholder="Doe">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" required class="form-control" placeholder="john.doe@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" id="subject" name="subject" required class="form-control" placeholder="Question about products">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" rows="5" required class="form-control" placeholder="Your message here..."></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-brand px-4 py-2">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<div id="successMessage">
    <p class="mb-0">✅ Thank you! Your message has been sent.</p>
</div>

<script>
    const contactForm = document.getElementById('contactForm');
    const successMessage = document.getElementById('successMessage');

    contactForm.addEventListener('submit', function(event) {
        event.preventDefault();

        if (contactForm.checkValidity()) {
            const formData = new FormData(contactForm);
            const submitButton = contactForm.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...';

            fetch(contactForm.action, {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' }
            }).then(response => {
                if (response.ok) {
                    successMessage.style.display = 'block';
                    setTimeout(() => {
                        successMessage.style.opacity = '1';
                        successMessage.style.transform = 'translateY(0)';
                    }, 10);

                    setTimeout(() => {
                        successMessage.style.opacity = '0';
                        successMessage.style.transform = 'translateY(-20px)';
                        setTimeout(() => {
                           successMessage.style.display = 'none';
                        }, 500);
                    }, 5000);

                    contactForm.reset();
                } else {
                    response.json().then(data => {
                        if (Object.hasOwn(data, 'errors')) {
                            alert(data["errors"].map(error => error["message"]).join(", "))
                        } else {
                            alert('Oops! There was a problem submitting your form');
                        }
                    })
                }
            }).catch(error => {
                console.error('Form submission error:', error);
                alert('Oops! There was a problem submitting your form');
            }).finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = 'Send Message';
            });
        } else {
            contactForm.classList.add('was-validated');
        }
    });
</script>

<?php
    // Include the footer
    include 'footer.php';
?>