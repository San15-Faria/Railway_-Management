<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        // Get form elements
        const from = document.getElementById('from');
        const to = document.getElementById('to');
        const date = document.getElementById('date');
        const trainClass = document.getElementById('class');

        // Check for empty fields
        if (from.value === '') {
            alert('Please select a departure location.');
            from.focus();
            event.preventDefault();
            return;
        }

        if (to.value === '') {
            alert('Please select a destination location.');
            to.focus();
            event.preventDefault();
            return;
        }

        if (date.value === '') {
            alert('Please select a date of travel.');
            date.focus();
            event.preventDefault();
            return;
        }

        if (trainClass.value === '') {
            alert('Please select a train class.');
            trainClass.focus();
            event.preventDefault();
            return;
        }

        // If all validations pass, allow form submission
        alert('Form submitted successfully!');
    });
</script>
