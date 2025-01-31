<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
</head>
<body>
	<h1>SignUp</h1>
	<form id="signin" method="post">
		<input type="text" name="username" placeholder="username">
		<input type="password" name="password" placeholder="password">
		<input type="text" name="names" placeholder="names">
		<input type="submit" name="createaccount">
	</form>
</body>
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
		$('#signin').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: 'http://localhost/Business_Manager_App/backend/signin',
                method: 'post',
                data: $(this).serialize(),
                success:function(response){
                    console.log(response);
                }
            });
            
        });
		
	});
</script>
</html>