<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>TRY</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <p>Destinatario:</p>
    <input type="text" id="mailTo">
    <p>Contenido:</p>
    <textarea id="content" rows="8" cols="80">This is a try</textarea>
    <br>
    <button type="button" onclick="sendMail()">Send!</button>
    <script type="text/javascript">
      function sendMail(){
        let mailTo = $('#mailTo').val();
        let body = $('#content').val();
        $.ajax({
          type: 'POST',
          url: 'send.php',
          data: {
            mailTo: mailTo,
            body: body
          },
          success: function(result){
            alert(result);
          }
        });
      }
    </script>
  </body>
</html>
