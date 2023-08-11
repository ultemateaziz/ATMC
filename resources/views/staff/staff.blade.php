@include('include.header')

<section id="staff">
   <h2>MENU</h2>
   <div class="menu-main">
        <div class="menu">
            <ul>
                <li><a href="{{url('/upload_index')}}">UPLOAD PROJECT LIST</a></li>
                <li><a href="{{url('/view-group')}}">VIEW GROUPS</a></li>
                <!--<li><a href="#">VIEW SFIA SKILLS</a></li>
                <li><a href="#">NOTIFY STUDENT</a></li>
                <li><a href="#">Manual Groups</a></li> -->
                <li><a href="{{url('/student_register')}}">Create a Student</a></li>
                <li style="background: #8282f6"><a href="{{url('/logout')}}" >Logout</a></li>
            </ul>
        </div>
    </div>
</section>



@include('include.footer')