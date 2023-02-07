<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
</style>

<div class="container">
	<div class="row">
        <div class="col-md-6">
    		<h2>Edit Image</h2>
            <div id="custom-search-input">
                <div class="col-md-12">
                    <button type="button" class="btn btn-info btn-lg create-variation" data-href="{{ url('/create-image-variations') . '?image_id=' . $image->id }}">
                        Create Image Variations
                    </button>
                </div>
            </div>
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
    $(".create-variation").click(function(){
        $(this).html('<i class="fa-solid fa-spinner fa-spin"></i> Processing...');
        $(this).css("pointer-events", "none");
        window.location.href = $(this).data('href');
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