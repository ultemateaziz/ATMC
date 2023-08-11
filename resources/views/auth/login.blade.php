@include('include.header')

<section id="staff-login">
    <h2>{{$user}} LOGIN PORTAL</h2>
    <br>
    <div class="login-main">
        <div class="login">
            <form id="myForm" action="{{url('/login-action')}}" method="POST">
                <div>
                    <input type="text" name="email" placeholder="email" id="email" required>
                </div>
               
                <div>
                    <input type="password" name="password" placeholder="password" id="pass" required>
                </div>
                @csrf
                <button type="submit" id="sub_btn">LOGIN</button>
                @error('email')
                    <span style="color: red;">{{$message}}</span>
                @enderror
            </form>
        </div>
    </div>
    @error('restricted')
    <div class="popup" id="popup" style="display: block;">
        <div class="popup-content">
            <span class="close" id="closePopupBtn">&times;</span>
            <h3>Error</h3>
            <br>
            <p id="popupMessage" style="text-align: center;">{{$message}}</p>
            
        </div>
    </div>
    @enderror
</section>

@include('include.footer')

<script>
    $('#sub_btn').click(function (){
        email = $('#email').val();
        password = $('#pass').val();

        $('#email').next('span').remove();
        $('#pass').next('span').remove();
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(email == '' || password == ''){
            if(email == ''){
                $('#email').parent().append("<span style='color: red;'>Please fill the Email</span>");
            }

            if(password == ''){
                $('#pass').parent().append("<span style='color: red;'>Please fill the Password</span>");
            }

            return false;
        }else if(!regex.test(email)) {
            $('#email').parent().append("<span style='color: red;'>Please enter valid mail address</span>")
            return false;
        }else{
            return true;
        }
    });

    $('#closePopupBtn').click(function (){
        $('#popup').hide();
    })
</script>
