<?php
$page_title = "FAQ";
include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['faq_heading']); ?></h1>
            <p class="lead mb-0 animate-on-scroll"><?php echo htmlspecialchars($siteSettings['faq_subtitle']); ?></p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Search FAQ -->
                    <div class="faq-search mb-5 animate-on-scroll">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control" id="faqSearch" placeholder="Search FAQs...">
                        </div>
                    </div>

                    <!-- FAQ Categories -->
                    <div class="faq-categories mb-5 animate-on-scroll">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button class="btn btn-outline-primary faq-category active" data-category="all">All</button>
                            <button class="btn btn-outline-primary faq-category" data-category="booking">Booking</button>
                            <button class="btn btn-outline-primary faq-category" data-category="menu">Menu & Food</button>
                            <button class="btn btn-outline-primary faq-category" data-category="service">Service</button>
                            <button class="btn btn-outline-primary faq-category" data-category="payment">Payment</button>
                        </div>
                    </div>

                    <!-- FAQ Accordion -->
                    <div class="accordion" id="faqAccordion">

                        <!-- Booking FAQs -->
                        <div class="faq-item" data-category="booking">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    How far in advance should I book my event?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We recommend booking at least 2-3 weeks in advance for small intimate gatherings (under 50 guests) and 4-6 weeks for larger events (50+ guests). For weddings and major corporate events, we suggest booking 6-12 months in advance to ensure availability of your preferred date and menu selections. However, we do accommodate last-minute bookings whenever possible.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="booking">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Can I make changes to my booking after it's confirmed?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we understand that plans can change. You can modify your booking up to 7 days before your event date. Changes may include guest count (within reasonable limits), menu selections, or timing. Please note that significant changes may affect pricing, and we recommend discussing any modifications with your catering coordinator as soon as possible to ensure we can accommodate your needs.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="booking">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    What is your cancellation policy?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our cancellation policy is designed to be fair and protect both parties. Cancellations made more than 14 days before the event receive a full refund minus a $100 administrative fee. Cancellations 7-14 days before the event are subject to a 50% cancellation fee. Cancellations within 7 days of the event are non-refundable. We recommend considering event cancellation insurance for larger events.
                                </div>
                            </div>
                        </div>

                        <!-- Menu & Food FAQs -->
                        <div class="faq-item" data-category="menu">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Do you accommodate dietary restrictions and allergies?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutely! We take dietary restrictions and allergies very seriously. We accommodate vegetarian, vegan, gluten-free, dairy-free, nut-free, and many other dietary needs. All menu items can be modified or prepared separately to ensure food safety. We require detailed information about allergies and restrictions at least 2 weeks in advance to properly prepare. Our team is trained in food safety protocols and cross-contamination prevention.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="menu">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    Can I request custom menu items or dietary substitutions?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we love working with clients to create custom menus! We can modify existing recipes, create entirely new dishes, or accommodate specific cultural or religious dietary requirements. Custom menu development typically requires 3-4 weeks advance notice and may involve additional costs depending on the complexity. We recommend discussing your custom menu needs during your initial consultation.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="menu">
                            <h2 class="accordion-header" id="heading6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    Do you offer food tasting sessions?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! We offer complimentary tasting sessions for events over $3,000. For smaller events, we provide detailed menu descriptions, photos, and virtual tasting options. Tastings are typically scheduled 2-4 weeks before your event and allow you to sample menu items, discuss presentation, and make final selections. We can accommodate up to 4 guests per tasting session.
                                </div>
                            </div>
                        </div>

                        <!-- Service FAQs -->
                        <div class="faq-item" data-category="service">
                            <h2 class="accordion-header" id="heading7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    What services are included in your catering packages?
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our full-service catering includes professional chefs, servers, setup and breakdown, all necessary equipment (china, glassware, linens), complete cleanup, and on-site coordination. We also provide bar service, cake cutting, and any special requests. For buffet-style service, we include chafing dishes, serving utensils, and disposable service items. All packages include a dedicated event coordinator to ensure everything runs smoothly.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="service">
                            <h2 class="accordion-header" id="heading8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    What is your service area and are there travel fees?
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We proudly serve the greater metropolitan area and surrounding regions within a 50-mile radius of our kitchen. There are no additional travel fees within this area. For destinations beyond 50 miles, we assess a reasonable travel fee based on distance and event size. We also offer off-site catering coordination services for events outside our standard service area.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="service">
                            <h2 class="accordion-header" id="heading9">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    Do you provide bartending services?
                                </button>
                            </h2>
                            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we offer full bar services including professional bartenders, bar setup, and liquor service. We can provide cash bars, hosted bars, or custom bar packages. All bartenders are licensed, insured, and trained in responsible service. We also offer non-alcoholic beverage service and can accommodate special drink requests or signature cocktails for your event.
                                </div>
                            </div>
                        </div>

                        <!-- Payment FAQs -->
                        <div class="faq-item" data-category="payment">
                            <h2 class="accordion-header" id="heading10">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    What are your payment terms and methods?
                                </button>
                            </h2>
                            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We require a 50% deposit to secure your date and begin preparations, with the remaining balance due 7 days before your event. We accept all major credit cards, checks, wire transfers, and digital payment platforms. For larger events, we can arrange payment plans. All payments are processed securely through our encrypted payment system.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="payment">
                            <h2 class="accordion-header" id="heading11">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                    Do you offer discounts for large events or multiple bookings?
                                </button>
                            </h2>
                            <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! We offer volume discounts for larger events and multiple bookings throughout the year. Events with 100+ guests receive automatic pricing adjustments, and we provide special rates for clients who book multiple events annually. We also offer early booking discounts for events scheduled more than 6 months in advance. Contact us for a custom quote to learn about available discounts.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="payment">
                            <h2 class="accordion-header" id="heading12">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    What is included in your pricing?
                                </button>
                            </h2>
                            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our pricing includes all food and beverage costs, professional service staff, setup and cleanup, basic rentals (tables, chairs, linens), and event coordination. Gratuity for service staff is typically 18-20% and can be added to your final bill. Additional costs may include premium rentals, special equipment, liquor licenses, or extraordinary transportation needs. We provide detailed, itemized quotes with no hidden fees.
                                </div>
                            </div>
                        </div>

                        <!-- Additional FAQs -->
                        <div class="faq-item" data-category="service">
                            <h2 class="accordion-header" id="heading13">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                    How many servers do you provide for my event?
                                </button>
                            </h2>
                            <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Server staffing is based on event size, style of service, and timeline. Generally, we provide 1 server per 15-20 guests for plated service, 1 server per 25-30 guests for buffet service, and additional staff for larger events or complex service requirements. All servers are professionally trained, uniformed, and experienced in fine dining service. We can adjust staffing levels based on your specific needs.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="menu">
                            <h2 class="accordion-header" id="heading14">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                    Can you accommodate special requests or theme-based menus?
                                </button>
                            </h2>
                            <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutely! We specialize in creating unique, themed menus that match your event's personality. Whether it's a destination wedding with local cuisine, a corporate event with international flavors, or a children's party with fun presentations, we can design custom menus around any theme. We work closely with you to incorporate special requests, signature dishes, or cultural elements that make your event memorable.
                                </div>
                            </div>
                        </div>

                        <div class="faq-item" data-category="booking">
                            <h2 class="accordion-header" id="heading15">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                    What happens if the weather affects my outdoor event?
                                </button>
                            </h2>
                            <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We monitor weather forecasts closely and have contingency plans for outdoor events. If severe weather is predicted, we can help arrange indoor alternatives, tent rentals, or reschedule your event. We also offer weather-protected serving options and have experience with various weather scenarios. Our team is prepared to adapt service style and setup to ensure your event is successful regardless of weather conditions.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-4 animate-on-scroll">Still have questions?</h2>
            <p class="lead mb-4 animate-on-scroll">Our team is here to help you plan the perfect event.</p>
            <div class="animate-on-scroll">
                <a href="contact.php" class="btn btn-light btn-lg me-3 px-4 py-3">
                    <i class="fas fa-envelope me-2"></i>Contact Us
                </a>
                <a href="tel:+15551234567" class="btn btn-outline-light btn-lg px-4 py-3">
                    <i class="fas fa-phone me-2"></i>Call Now
                </a>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('faqSearch');
        const categoryButtons = document.querySelectorAll('.faq-category');
        const faqItems = document.querySelectorAll('.faq-item');

        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            faqItems.forEach(item => {
                const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                const answer = item.querySelector('.accordion-body').textContent.toLowerCase();

                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Category filtering
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update active button
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const category = this.dataset.category;

                faqItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
    </script>

<?php include 'footer.php'; ?>