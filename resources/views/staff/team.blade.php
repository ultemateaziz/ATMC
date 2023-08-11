@include('include.header')

<section id="staff">
    <div class="upload">
      <h3>VIEW GROUPS</h3>
    </div>
</section>
   <br>
<section id="project">
    <div class="project">
        @foreach($final as $key => $value)
        <div class="project-list">
            <h3>Group - {{$key}}</h3>
            <ul>
                @foreach($value as $val)
                <li>{{$val}}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
        <!--
        <div class="project-list">
        <h3>Group - Project 1</h3>
        </div>
        <div class="project-list">
        <h3>Group - Project 2</h3>
        </div>
        <div class="project-list">
        <h3>Group - Project 3</h3>
        </div>
        <div class="project-list">
        <h3>Group - Project 4</h3>
        </div>
        <div class="project-list">
         <h3>Group - Project 5</h3>
        </div>
        <div class="project-list">
         <h3>Group - Project 6</h3>
        </div>
        <div class="project-list">
           <h3>Group - Project 7</h3>
        </div>
        <div class="project-list">
         <h3>Group - Project 8</h3>
        </div>
        <div class="project-list">
         <h3>Group - Project 9</h3>
        </div>
        -->
    </div>

</section>


@include('include.footer')
