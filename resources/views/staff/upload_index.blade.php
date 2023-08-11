@include('include.header')

<section id="staff">
    <div class="upload">
      <h3>UPLOAD PROJECT LIST</h3>
    </div>
    <br>

    <br>
    <form action="POST" enctype="multipart/form-data" id="upload_file">
        <div class="upload-container">
            <div>
                <input type="file" name="upld_file" id="upld_file">
            </div>
            <br>
            <div>
                <input type="text" name="file_name" id="file_name" placeholder="File Name">
            </div>
            @csrf
        </div>
        <br>
        <div class="btn">
            <div>
                <button type="submit" id="openPopupBtn">Submit</button>
            </div>
        </div>
    </form>
    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close" id="closePopupBtn">&times;</span>
            <h3>IMPORTANT</h3>
            <br>
            <p id="popupMessage">PROJECT LIST SUCCESSFULLY ADDED!</p>
        </div>
    </div>

</section>

<script>

    
        
    $('#upload_file').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        if(!$('#upld_file').val())
        {
            alert('Please Select File');
            return false;
        }

        $.ajax({
            type:'POST',
            beforeSend:function (){
                $('#openPopupBtn').attr('disabled',true);
                $('#openPopupBtn').css('background: #383838');
            },
            url: "{{ url('upload_file')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                this.reset();
                $('#openPopupBtn').attr('disabled',false);
                $('#openPopupBtn').css('background: #8282f6');
                if(data=='success'){
                    alert('File has been uploaded successfully');
                }
                
            },
            error: function(result){
                if(result.status === 422){
                    var errors = $.parseJSON(result.responseText);
                    alert(errors.message);
                }
            }
        });
    });

    /*

    $.ajax({
        url:"{{url('upload_file')}}",
        method: 'POST',

    }); */
</script>

@include('include.footer')