$(function() {

    var owner = $('#owner');
    var name = $('#name');
    var email = $('#email');
    var mail = $('mail');
    var cardNumber = $('#cardNumber');
    var cardNumberField = $('#card-number-field');
    var CVV = $("#cvv");
    var mastercard = $("#mastercard");
    var confirmButton = $('#confirm-purchase');
    var visa = $("#visa");
    var amex = $("#amex");
    var experationDate = $("#expiration-date")
    var seq;
    var nm;
    var ml;
    var ad;
    
    // Use the payform library to format and validate
    // the payment fields.

    cardNumber.payform('formatCardNumber');
    CVV.payform('formatCardCVC');


    cardNumber.keyup(function() {

        amex.removeClass('transparent');
        visa.removeClass('transparent');
        mastercard.removeClass('transparent');

        if ($.payform.validateCardNumber(cardNumber.val()) == false) {
            cardNumberField.addClass('has-error');
        } else {
            cardNumberField.removeClass('has-error');
            cardNumberField.addClass('has-success');
        }

        if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
            mastercard.addClass('transparent');
            amex.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
            mastercard.addClass('transparent');
            visa.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
            amex.addClass('transparent');
            visa.addClass('transparent');
        }
    });

    confirmButton.click(function(e) {

        e.preventDefault();

        var isCardValid = $.payform.validateCardNumber(cardNumber.val());
        var isCvvValid = $.payform.validateCardCVC(CVV.val());
        
        if(name.val().length < 3)
        {
            alert("Enter valid name");
        }else if(email.val().length <= 5){
            alert("Enter valid email");
        }else if(owner.val().length < 5){
            alert("Wrong owner name");
        } else if (!isCardValid) {
            alert("Wrong card number");
        } else if (!isCvvValid) {
            alert("Wrong CVV");
        } else if (experationDate <= 11 && experationDate == 16)
        {
            alert("Wrong experation date");
        }
        else {
            // Everything is correct. Add your form submission code here.
            

                            
           
            //seq = (Math.floor(Math.random() * 1000000000) + 1000000000).toString().substring(1);
           //document.write("Authorization Number: ", seq);
           //var form = document.getelementsById("pay-now");
           //form.submit();

           alert("Information is valid");
          // window.location.href = "http://students.cs.niu.edu/~z1912837/savedata.php";
          var nodemailer = require('nodemailer');

            var transporter = nodemailer.createTransport({
             service: 'gmail',
                 auth: {
                 user: 'patelwalwerparts@gmail.com',
                 pass: 'caw12345'
            }
            });

            var mailOptions = {
                from: 'patelwalwerparts@gmail.com',
                to: 'reply@codexworld.com',
                subject: 'Sending Email using Node.js',
                text: 'That was easy!'
            };

            transporter.sendMail(mailOptions, function(error, info){
             if (error) {
              alert("error");
            } else {
              alert("Email Sent: ' + info.response");
            }
            });
            
        };
        
        
    });
});
