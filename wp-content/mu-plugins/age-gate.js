/**
 * Age Gate JavaScript
 * Handles age verification form and compliance
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        initAgeGate();
    });
    
    function initAgeGate() {
        const ageGate = $('#skyworld-age-gate');
        const underageModal = $('#underage-modal');
        const verificationForm = $('#age-verification-form');
        const birthDateInput = $('#birth-date');
        const exitBtn = $('.age-exit-btn');
        const closeModalBtn = $('.close-modal-btn');
        
        // Handle form submission
        verificationForm.on('submit', function(e) {
            e.preventDefault();
            
            const birthDate = birthDateInput.val();
            if (!birthDate) {
                alert('Please enter your date of birth.');
                return;
            }
            
            // Calculate age
            const birth = new Date(birthDate);
            const today = new Date();
            const age = Math.floor((today - birth) / (365.25 * 24 * 60 * 60 * 1000));
            
            if (age >= 21) {
                // Set loading state
                verificationForm.addClass('loading');
                
                // Submit to server
                $.ajax({
                    url: skyworld_age_gate.ajax_url,
                    type: 'POST',
                    data: {
                        action: 'verify_age',
                        birth_date: birthDate,
                        nonce: skyworld_age_gate.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            // Hide age gate with animation
                            ageGate.fadeOut(500, function() {
                                $(this).remove();
                            });
                            
                            // Re-enable scrolling
                            $('body').removeClass('age-gate-active');
                        } else {
                            alert('Verification failed. Please try again.');
                            verificationForm.removeClass('loading');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                        verificationForm.removeClass('loading');
                    }
                });
            } else {
                // Show underage modal
                showUnderageModal();
            }
        });
        
        // Handle exit button
        exitBtn.on('click', function() {
            showUnderageModal();
        });
        
        // Handle close modal button
        closeModalBtn.on('click', function() {
            // Redirect to external site
            window.location.href = 'https://www.google.com';
        });
        
        // Prevent closing with escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                e.preventDefault();
                return false;
            }
        });
        
        // Disable right-click context menu on age gate
        ageGate.on('contextmenu', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Disable scrolling when age gate is active
        $('body').addClass('age-gate-active');
        
        // Focus on birth date input
        setTimeout(function() {
            birthDateInput.focus();
        }, 500);
        
        function showUnderageModal() {
            ageGate.fadeOut(300, function() {
                underageModal.fadeIn(300);
            });
        }
        
        // Handle browser back/forward
        window.addEventListener('popstate', function(e) {
            e.preventDefault();
            // Keep user on age gate
            history.pushState(null, null, window.location.href);
        });
        
        // Add initial history state
        history.pushState(null, null, window.location.href);
    }
    
})(jQuery);

// Additional body styles for age gate
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('skyworld-age-gate')) {
        document.body.style.overflow = 'hidden';
    }
});