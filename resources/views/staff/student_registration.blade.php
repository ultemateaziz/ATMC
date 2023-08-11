@include('include.header')

<section id="staff-login">
    <h2>NEW STUDENT REGISTRATION</h2>
    <br>
    <div class="login-main">
       <div class="login">
            <div>
                <input type="text" name="email" placeholder="email" id="email" required>
            </div>
            <div>
                <input type="password" name="password" placeholder="password" id="pass" required>
            </div>
            <div>
                <input type="password" name="confirm_password" placeholder="confirm password" id="c_pass" required>
            </div>
            <button type="button" id="register">REGISTER</button>
           
        </div>
    </div>
</section>

<script>
    $('#register').click(function (){
        email = $('#email').val();
        password = $('#pass').val();
        c_password = $('#c_pass').val();

        $('#email').next('span').remove();
        $('#pass').next('span').remove();
        $('#c_pass').next('span').remove();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(email == '' || password == ''){
            if(email == ''){
                $('#email').parent().append("<span style='color: red;'>Please fill the Email</span>");
            }

            if(password == ''){
                $('#pass').parent().append("<span style='color: red;'>Please fill the Password</span>");
            }

            if(c_password == '')
            {
                $('#c_pass').parent().append("<span style='color: red;'>Please fill the Confirm Password</span>");
            }

            return false;
        }else if(!regex.test(email)) {
            $('#email').parent().append("<span style='color: red;'>Please enter valid mail address</span>")
            return false;
        }else if(password != c_password){
            $('#c_pass').parent().append("<span style='color: red;'>Passwords did not match</span>");
            return false
        }else{
            formData = {email:email,password:password,confirm_password:c_password,_token:"{{csrf_token()}}"};
            $.ajax({
                url: "{{url('new_student')}}",
                method: 'post',
                data: formData,
                success: function (response){   
                    result = $.trim(response);
                    if(result == 'success'){
                        $('#email').val('');
                        $('#pass').val('');
                        $('#c_pass').val('');

                        alert('Student created successfully');
                    }else{
                        alert('Error');
                    }
                },
                error: function (result){
                    if(result.status === 422){
                        var errors = $.parseJSON(result.responseText);
                        console.log(errors.message);
                        email_error = errors.message.includes('email');
                        if(email_error){
                            alert(errors.message);
                        }
                    }
                }
            });
        }
    });
</script>
@include('include.footer')