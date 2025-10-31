<?php
/**
 * Template Name: Contact
 * 
 * Template for contact page
 */

get_header(); ?>

<main class="main-content contact-page">
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="page-title">Contact Skyworld</h1>
                <p class="hero-subtitle">Get in touch with our team for retail partnerships, product information, or general inquiries</p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-content">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form-section">
                    <h2>Send Us a Message</h2>
                    <form class="contact-form" method="post" action="">
                        <div class="form-group">
                            <label for="contact-name">Full Name *</label>
                            <input type="text" id="contact-name" name="contact_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-email">Email Address *</label>
                            <input type="email" id="contact-email" name="contact_email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-phone">Phone Number</label>
                            <input type="tel" id="contact-phone" name="contact_phone">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-company">Company/Dispensary</label>
                            <input type="text" id="contact-company" name="contact_company">
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-subject">Subject *</label>
                            <select id="contact-subject" name="contact_subject" required>
                                <option value="">Select a subject</option>
                                <option value="retail-partnership">Retail Partnership</option>
                                <option value="product-info">Product Information</option>
                                <option value="lab-results">Lab Results / COAs</option>
                                <option value="general">General Inquiry</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="contact-message">Message *</label>
                            <textarea id="contact-message" name="contact_message" rows="6" required placeholder="Tell us how we can help..."></textarea>
                        </div>
                        
                        <div class="form-disclaimer">
                            <p><small>By submitting this form, you confirm you are 21+ years of age and agree to our privacy policy.</small></p>
                        </div>
                        
                        <button type="submit" class="submit-button">Send Message</button>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div class="contact-info-section">
                    <h2>Get In Touch</h2>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p><a href="mailto:info@skyworldcannabis.com">info@skyworldcannabis.com</a></p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🏪</div>
                        <div class="contact-details">
                            <h3>Retail Partnerships</h3>
                            <p>Interested in carrying Skyworld products?</p>
                            <a href="/supply-agreement/" class="info-link">View Retail Onboarding →</a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">🔬</div>
                        <div class="contact-details">
                            <h3>Lab Results</h3>
                            <p>View certificates of analysis for all batches</p>
                            <a href="/labs/" class="info-link">Browse COAs →</a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h3>Store Locator</h3>
                            <p>Find Skyworld products near you</p>
                            <a href="/store-locator/" class="info-link">Find Stores →</a>
                        </div>
                    </div>
                    
                    <!-- License Info -->
                    <div class="license-section">
                        <h3>Licensed Operations</h3>
                        <div class="license-badges">
                            <div class="license-badge">
                                <strong>Processing</strong><br>
                                #OCM-PROC-24-000030
                            </div>
                            <div class="license-badge">
                                <strong>Cultivation</strong><br>
                                #OCM-CULT-2023-000179
                            </div>
                        </div>
                        <p>Licensed by New York State Office of Cannabis Management</p>
                    </div>
                    
                    <!-- Social Links -->
                    <div class="social-section">
                        <h3>Follow Us</h3>
                        <div class="social-links">
                            <a href="https://www.instagram.com/skyworldsmoke/" class="social-link" target="_blank">
                                <span>📷</span> Instagram
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Contact Page Styles */
.contact-page {
    background: var(--color-background);
    color: var(--color-text);
}

.contact-hero {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
    color: white;
    padding: 100px 0;
    text-align: center;
}

.contact-hero .page-title {
    font-family: 'SkyFont-Black', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    margin-bottom: 1.5rem;
    letter-spacing: -0.02em;
}

.contact-hero .hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
}

.contact-content {
    padding: 5rem 0;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    max-width: 1200px;
    margin: 0 auto;
}

.contact-form-section h2,
.contact-info-section h2 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 2rem;
    margin-bottom: 2rem;
    color: var(--color-text);
}

.contact-form {
    background: var(--color-surface);
    padding: 2rem;
    border-radius: 12px;
    border: 1px solid var(--color-border);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--color-text);
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid var(--color-border);
    border-radius: 8px;
    background: var(--color-background);
    color: var(--color-text);
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.form-disclaimer {
    margin-bottom: 1.5rem;
    color: var(--color-text-muted);
}

.submit-button {
    width: 100%;
    padding: 1rem 2rem;
    background: var(--color-primary);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1.125rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.submit-button:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
}

.contact-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--color-surface);
    border-radius: 12px;
    border: 1px solid var(--color-border);
}

.contact-icon {
    font-size: 1.5rem;
    min-width: 40px;
}

.contact-details h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
    color: var(--color-text);
}

.contact-details p {
    color: var(--color-text-muted);
    margin-bottom: 0.5rem;
}

.contact-details a {
    color: var(--color-text);
    text-decoration: none;
}

.contact-details a:hover {
    color: var(--color-primary);
}

.info-link {
    color: var(--color-primary) !important;
    font-weight: 500;
    transition: color 0.3s ease;
}

.info-link:hover {
    color: var(--color-primary-dark) !important;
}

.license-section {
    background: var(--color-surface);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid var(--color-border);
    margin-bottom: 2rem;
}

.license-section h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.25rem;
    margin-bottom: 1rem;
    color: var(--color-text);
}

.license-badges {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.license-badge {
    background: var(--color-background);
    padding: 0.75rem;
    border-radius: 8px;
    border: 1px solid var(--color-border);
    font-size: 0.875rem;
    text-align: center;
    flex: 1;
    min-width: 120px;
}

.license-section p {
    color: var(--color-text-muted);
    font-size: 0.9rem;
}

.social-section {
    background: var(--color-surface);
    padding: 1.5rem;
    border-radius: 12px;
    border: 1px solid var(--color-border);
}

.social-section h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.25rem;
    margin-bottom: 1rem;
    color: var(--color-text);
}

.social-links {
    display: flex;
    gap: 1rem;
}

.social-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: var(--color-primary);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .contact-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .contact-hero {
        padding: 80px 0;
    }
    
    .contact-content {
        padding: 3rem 0;
    }
    
    .contact-form {
        padding: 1.5rem;
    }
    
    .license-badges {
        flex-direction: column;
    }
    
    .social-links {
        flex-wrap: wrap;
    }
}
</style>

<?php 
// Handle form submission
if ($_POST && isset($_POST['contact_name'])) {
    // Basic form processing (you'd want to add proper validation and email sending)
    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);
    
    // Here you would typically send an email or save to database
    echo '<script>alert("Thank you for your message! We\'ll get back to you soon.");</script>';
}

get_footer(); ?>