<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    #custom-search-input{
        padding: 3px;
        border: solid 1px #E4E4E4;
        border-radius: 6px;
        background-color: #fff;
    }

    #custom-search-input input{
        border: 0;
        box-shadow: none;
    }

    #custom-search-input button{
        margin: 2px 0 0 0;
        background: none;
        box-shadow: none;
        border: 0;
        color: #666666;
        padding: 0 8px 0 10px;
        border-left: solid 1px #ccc;
    }

    #custom-search-input button:hover{
        border: 0;
        box-shadow: none;
        border-left: solid 1px #ccc;
    }

    #custom-search-input .glyphicon-search{
        font-size: 23px;
    }
</style>

<div class="container">
	<div class="row">
        <div class="col-md-6">
    		<h2>Edit Image</h2>
            <form id="img_form" method="POST" action="{{ url('/') }}">
                @csrf
                <div id="custom-search-input">
                    <div class="col-md-12">
                            <a class="btn btn-info btn-lg" href="{{ url('/create-image-variations') . '?image_id=' . $image->id }}">
                                Create Image Variations
                            </a>
                    </div>
                </div>
            </form>
        </div>
	</div>
    <div class="row">
        <br>
        <div class="col-md-4">
        <img src="{{ asset('storage') . '/' . $image->filename }}" width="100%" height="auto">
        </div>
        @foreach($image->Variations as $img)
        <div class="col-md-4">
            <img src="{{ asset('storage') . '/' . $img->filename }}" width="100%" height="auto">
        </div>
            @endforeach
    </div>
</div>

<script>
    $(".copy-img-url").click(function(){
        copyToClipboard($('#img_name').val());
    });
    function copyToClipboard(text) {
        var textArea = document.createElement( "textarea" );
        textArea.value = text;
        document.body.appendChild( textArea );
        textArea.select();
        try {
            var successful = document.execCommand( 'copy' );
            var msg = successful ? 'successful' : 'unsuccessful';
            alert('Image URL copied to clipboard');
        } catch (err) {
            console.log('Oops, unable to copy',err);
        }    
        document.body.removeChild( textArea );
    }
</script>