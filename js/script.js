// Basic form validation


document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const inputs = form.querySelectorAll('input[required]');
            
		inputs.forEach(input => {
                if (!input.value.trim()) {
                    alert(`${input.placeholder} is required.`);
                    e.preventDefault();
                }
            });
        });
    });
});