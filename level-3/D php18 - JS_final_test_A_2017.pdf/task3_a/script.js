let nameNotified = false;
let passwordNotified = false;
    
$('#btn').on('click', function(e) {
    e.preventDefault();

    let password = $('#pd');
    let name = $('#name');

    let nameError = name.val() === '';
    let passwordError = password.val() === '' || password.val().length < 6;
    
    if (nameError && !nameNotified) {
        name.parents().eq(0).append(' Name mustn\'t be empty.');
        name.parents().eq(0).css({ color: 'red' });
        nameNotified = true;
    } 

    if (passwordError && !passwordNotified) {
        password.parent().eq(0).append(' Password mustn\'t be empty or shorter than 6 symbols.');
        password.parent().eq(0).css('color', 'red');
        passwordNotified = true;
    } 

    if (!nameError && !passwordError) {
        let successMessage = $('<p></p>').text('Success!');
        $('body').append(successMessage);
    }
});