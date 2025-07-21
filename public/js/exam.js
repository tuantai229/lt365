document.addEventListener('DOMContentLoaded', function() {
    // Accordion functionality
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    
    accordionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.accordion-icon i');
            
            // Toggle active class on the content
            content.classList.toggle('active');
            
            // Change icon based on active state
            if (content.classList.contains('active')) {
                icon.classList.remove('ri-add-line');
                icon.classList.add('ri-subtract-line');
            } else {
                icon.classList.remove('ri-subtract-line');
                icon.classList.add('ri-add-line');
            }
        });
    });

    // Custom Checkbox functionality
    const customCheckboxes = document.querySelectorAll('.custom-checkbox');
    
    customCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function() {
            this.classList.toggle('checked');
        });
    });
    
    // Custom Radio button functionality
    const customRadios = document.querySelectorAll('.custom-radio');
    
    customRadios.forEach(radio => {
        radio.addEventListener('click', function() {
            // Find all radio buttons in the same form/group
            const form = this.closest('form');
            let radiosInGroup;

            if (form) {
                // If inside a form, scope to the form
                radiosInGroup = form.querySelectorAll('.custom-radio');
            } else {
                // If not in a form, handle as a global group (less ideal but a fallback)
                // This might need adjustment based on actual HTML structure if radios are outside forms
                radiosInGroup = document.querySelectorAll('.custom-radio');
            }
            
            // Uncheck all radios in the group
            radiosInGroup.forEach(r => {
                r.classList.remove('checked');
            });
            
            // Check the clicked radio
            this.classList.add('checked');
        });
    });
});
