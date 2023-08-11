@include('include.header')
<!-- for multi select values in dropdown --> 
<link rel="stylesheet" href="{{asset('css/select2.min.css')}}"> 
<style>
    button:disabled{
        background: #383838;
        color: white;
    }
</style>
<section id="staff" class="student_sec1">
    <div class="profile-icon-container">
        <img src="{{asset('images/profile-icon-9.png')}}" alt="" class="profile-icon">
    </div>
    <h2>PLEASE ENTER YOUR GPA</h2>
    <br>
    <div class="login-main">
        <div class="login">
            <input type="text" name="gpa" placeholder="GPA" id="gpa_i" required>
            <button type="button" id="gpa_g" onclick="section(2,'f')" disabled>Next</button>
        </div>
    </div>
</section>

<section id="staff" class="student_sec2" style="display: none;">
    <div class="profile-icon-container">
    <img src="{{asset('images/profile-icon-9.png')}}" alt="" class="profile-icon">
    </div>
   <h2>PLEASE CHOOSE YOUR THREE SFIA SKILLS</h2>
   <br>

    <br>
    <!--
    <div class="skills-container">
        <div class="skills-container-list"> -->
        <div style="justify-content: center; display: flex;">
            <select  id="sfia_skill" name="sfia_skills[]" multiple="multiple" style="width: 30%">
                <option value="Systems Software (SYSP)">Systems Software (SYSP)</option>
                <option value="Data Analysis (DTAN)">Data Analysis (DTAN)</option>
                <option value="Data & information management">Data & information management</option>
                <option value="IT Gov.& organisation issues">IT Gov.& organisation issues</option>
                <option value="Information Analysis (INAN)">Information Analysis (INAN)</option>
                <option value="Research (RSCH)">Research (RSCH)</option>
                <option value="System acquistion">System acquistion</option>
                <option value="Business Process Improvement (BPRE)">Business Process Improvement (BPRE)</option>
                <option value="Business Analysis (BUAN)">Business Analysis (BUAN)</option>
                <option value="Network Support (NTAS)">Network Support (NTAS)</option>
                <option value="System Design (DESN)">System Design (DESN)</option>
                <option value="Technical Specialism (TECH)">Technical Specialism (TECH)</option>
                <option value="Programming / Software development (PROG)">Programming / Software development (PROG)</option>
                <option value="Testing (TEST)">Testing (TEST)</option>
                <option value="Technical Specialism (TECH)">Technical Specialism (TECH)</option>
                <option value="IT Operations (ITOP)">IT Operations (ITOP)</option>
                <option value="Information Security (SCTY)">Information Security (SCTY)</option>
                <option value="Network support (NTAS)">Network support (NTAS)</option>
            </select>
        </div><!--
        </div>
    </div> -->
    <br>
    <h3 style="justify-content: center;display: flex;">Project Details Report</h3>
    <ul style="justify-content: center;display: flex;">
        @if(isset($upload_items))
            @foreach($upload_items as $value)
                <li><a href="{{asset('pdf/'.$value->upload_file)}}" target="_blank">{{$value->file_name}}</a></li>
            @endforeach
        @endif
    </ul>
    <br>
    <div class="btn">
        <div>
            <button type="button" id="gpa" onclick="section(1,'b')">Back</button>
            <button type="button" id="gpa_s" onclick="section(3,'f')" disabled>Next</button>
        </div>
    </div>
</section>

<section id="staff" class="student_sec3" style="display: none;">

    <h2>PLEASE CHOOSE YOUR PROJECT IN THE ORDER PREFERENCE</h2>
    <br>
    <br>
    <div style="justify-content: center; display: flex;">
        <select  id="project_list" name="project_list[]" multiple="multiple" style="width: 30%">
            <option value="1">Project 1</option>
            <option value="2">Project 2</option>
            <option value="3">Project 3</option>
            <option value="4">Project 4</option>
            <option value="5">Project 5</option>
            <option value="6">Project 6</option>
            <option value="7">Project 7</option>
            <option value="8">Project 8</option>
            <option value="9">Project 9</option>
        </select>
    </div>
    <div class="btn">
        <div>
            <button type="button" id="gpa" onclick="section(2,'b')">Back</button>
            <button type="button" id="gpa_p" onclick="section(4,'f')" disabled>Next</button>
        </div>
    </div>
</section>

<section id="staff" class="student_sec4" style="display: none;">
    <div class="profile-icon-container">
      <img src="{{asset('images/profile-icon-9.png')}}" alt="" class="profile-icon">
    </div>
    <h2>Please write down any 3 classmates name that you wish to group in for project</h2>
    <br>

    <br>
    <div class="skills-container">
        <input type="text" name="student_name" placeholder="Enter Your name" id="student_name">&emsp;
        <input type="text" name="second_student" placeholder="Enter name of the student" id="second_student">&emsp;
        <input type="text" name="third_student" placeholder="Enter name of the student" id="third_student">
    </div>
    
    <div class="btn">
    <div>
        <button type="button" id="gpa" onclick="section(3,'b')">Back</button>
        <button type="button" id="openPopupBtn" value="submit" disabled>Submit</button>
    </div>
    </div>
    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" id="closePopupBtn">&times;</span>
            <h3>Success</h3>
            <br>
            <p id="popupMessage">Your Bid has been submitted. We will notify about your group shortly!</p>
            <a href="{{url('/logout')}}"><button>Okay</button></a>
        </div>
    </div>
    

</section>

<!-- for multi select drop down -->
<script src="{{asset('js/select2.full.min.js')}}"></script>
<script>

    

    $(document).ready(function(){
        $('#sfia_skill').select2();
        $('#project_list').select2();
        
        
        // Validation 
        $('#gpa_i').keyup(function (){
            var gpa_len = $(this).val().length;
            if(gpa_len >= 7){
                $('#gpa_g').attr('disabled', false);
                $('#gpa_g').css('background: #8282f6');
            }else{
                $('#gpa_g').attr('disabled', true);
                $('#gpa_g').css('background: #383838');
            }
        });

        
        $('#sfia_skill').on('select2:select', function (e) {
            $('#sfia_skill').select2({
                maximumSelectionLength: 3
            });

            var sfia_len = $('#sfia_skill').val().length;
            if(sfia_len == 3){
                $('#gpa_s').attr('disabled', false);
                $('#gpa_s').css('background: #8282f6');
            }
        });

        $('#sfia_skill').on('select2:unselect', function (e) {
            $('#gpa_s').attr('disabled', true);
            $('#gpa_s').css('background: #383838');
        });
        

        $('#project_list').on('select2:select', function (e) {
            $('#project_list').select2({
                maximumSelectionLength: 3
            });
            var proj_len =  $('#project_list').val().length;
            if(proj_len == 3){
                $('#gpa_p').attr('disabled', false);
                $('#gpa_p').css('background: #8282f6');
            }
            var element = e.params.data.element;
            var $element = $(element);
            
            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });

        $('#project_list').on('select2:unselect', function (e) {
            $('#gpa_p').attr('disabled', true);
            $('#gpa_p').css('background: #383838');
        });


        $('#student_name').keyup(function (){
            var stu_length = $(this).val().length;

            if(stu_length >= 3){
                $('#openPopupBtn').attr('disabled', false);
                $('#openPopupBtn').css('background: #383838');
            }else{
                $('#openPopupBtn').attr('disabled', true);
                $('#openPopupBtn').css('background: #8282f6');
            }
            
        });

        $('#openPopupBtn').click(function (){
            
            var gpa = $('#gpa_i').val();
            var sfia_skill = $('#sfia_skill').val();
            var project_list = $('#project_list').val();
            var student_name = $('#student_name').val();
            var second_student = $('#second_student').val();
            var third_student = $('#third_student').val();
        
            formData = {gpa:gpa,sfia_skill:sfia_skill,project_list:project_list,student_name:student_name,second_student:second_student,third_student:third_student,_token:"{{csrf_token()}}"};
            
            
            $.ajax({
                url: "{{url('student_save')}}",
                method: 'post',
                beforeSend: function (){
                    $('#openPopupBtn').attr('disabled', true);
                    $('#openPopupBtn').css('background: #8282f6');
                },
                data: formData,
                success: function (response){   
                    result = $.trim(response);
                    if(result == 'success'){
                        $('#popup').show();
                    }else if(result == 'restricted'){
                        alert('You are restricted. Please contact Admin');
                    }else{
                        alert('Error');
                    }
                },
                error: function (result){
                    if(result.status === 422){
                        var errors = $.parseJSON(result.responseText);
                        console.log(errors.message);
                    }
                }
            });
            

            
            
        })

        $('#closePopupBtn').click(function (){
            $('#popup').hide();
        })
    });
    function section(id,id1){
        if(id1=='f'){
            s_id = id;
            h_id = id - 1;
            $('.student_sec'+h_id).hide();
            $('.student_sec'+s_id).show();
        }else{
            s_id = id;
            h_id = id + 1;
            $('.student_sec'+h_id).hide();
            $('.student_sec'+s_id).show();
        }
    }


</script>


@include('include.footer')