$(document).ready(function(){
    const checkboxes = $('.row-checkbox');
    const performActionBtn = $('#performAction');

    checkboxes.on('change', function(){
        const checkedCheckboxes = $('.row-checkbox:checked');
        if (checkedCheckboxes.length > 2) {
            this.checked = false;
            alert('You can only select two rows.');
        }
        performActionBtn.prop('disabled', checkedCheckboxes.length !== 2);
    });

    performActionBtn.on('click', function(){
        const selectedRows = [];
        $('.row-checkbox:checked').each(function(){
            const row = $(this).closest('tr');
            const rowData = {
                col1: row.find('td:eq(1)').text(),
                col2: row.find('td:eq(2)').text()
            };
            selectedRows.push(rowData);
        });

        const data = {};
        selectedRows.forEach((row, index) => {
            data[`row${index}[col1]`] = row.col1;
            data[`row${index}[col2]`] = row.col2;
        });

        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: data,
            success: function(response){
                $('#result').html(response);
            },
            error: function(xhr, status, error){
                console.error('Error:', error);
            }
        });
    });
});
