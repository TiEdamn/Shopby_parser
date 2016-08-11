<html>
<head>
	<meta charset="UTF-8"/>
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<style>
		.results p img{
			height: 20px;
		}
	</style>
</head>
<body>
<input type="text" class="url" placeholder="Введите адрес категории shop.by" size="40" /><button name="btn" class="btn">Поехали</button><br/><br/>
<div class="results"></div>

<script language="javascript" type="text/javascript">

    $('.btn').click( function() {
        
        $.ajax({
          type: 'POST',
          url: 'response.php',
          data: 'url=' + $('.url').val(),
		  beforeSend: function(){
            $('.results').html('<img src="loader.gif">');
        },
          success: function(data){
            $('.results').html(data);
          }
        });
		

    });
    </script>
</body>
</html>