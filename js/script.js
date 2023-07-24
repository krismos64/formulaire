$(function () {
  $("#contact-form").submit(function (e) {
    e.preventDefault();
    $(".comments").empty();
    var postdata = $("#contact-form").serialize();

    $.ajax({
      type: "POST",
      url: "php/contact.php",
      data: postdata,
      dataType: "json",
      success: function (result) {
        if (result.isSuccess) {
          $("#contact-form").append(
            "<p class='thank-you'>Votre message a bien été envoyé. Merci de nous avoir contacté !</p>"
          );
          $("#contact-form")[0].reset();
        } else {
          $("#firstname + .comment").html(result.firstnameError);
          $("#name + .comment").html(result.nameError);
          $("#email + .comment").html(result.emailError);
          $("#phone + .comment").html(result.phoneError);
          $("#message + .comment").html(result.messageError);
        }
      },
    });
  });
});
