jQuery(document).ready(function($) {
    // Initialize progress bar
    function initProgressBar() {
        if ($('.mp-sct-progress-container').length === 0) {
            $('body').prepend('<div class="mp-sct-progress-container"><div class="mp-sct-progress-fill"></div></div>');
        }
    }

    // Update progress bar
    function updateProgressBar() {
        const windowHeight = $(window).height();
        const docHeight = $(document).height();
        const scrollTop = $(window).scrollTop();
        const progress = (scrollTop / (docHeight - windowHeight)) * 100;
        
        $('.mp-sct-progress-fill').css('width', progress + '%');
    }

    // Throttle scroll events
    let isScrolling;
    $(window).scroll(function() {
        window.clearTimeout(isScrolling);
        isScrolling = setTimeout(() => {
            updateProgressBar();
        }, 50);
    });

    // Initial setup
    initProgressBar();
    updateProgressBar();
});